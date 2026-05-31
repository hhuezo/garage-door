<section class="bg-background px-4 py-12 sm:px-6 sm:py-16 md:py-20">
    <div class="mx-auto max-w-6xl">
        <div class="contact-card overflow-hidden p-6 md:p-8 lg:p-10">
            <h2 class="mb-2 font-headline text-lg font-bold text-primary md:text-xl">Schedule an appointment</h2>
            <p class="mb-6 text-sm text-on-surface-variant md:text-[0.9375rem]">Pick a date and available time. Sundays are not available.</p>

            <form id="appointment-form" class="space-y-4 md:space-y-5" method="post" action="{{ route('contact.appointment.store') }}">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-5">
                    <div>
                        <label class="contact-label" for="appointment-date">Appointment date</label>
                        <input
                            class="contact-input"
                            id="appointment-date"
                            name="appointment_date"
                            type="date"
                            value="{{ old('appointment_date') }}"
                            min="{{ $appointmentMinDate ?? now()->toDateString() }}"
                            max="{{ $appointmentMaxDate ?? now()->addDays(30)->toDateString() }}"
                            required
                        />
                        @error('appointment_date')
                            <p class="mt-1 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="contact-label" for="appointment-time-slot">Available time</label>
                        <select
                            class="contact-input"
                            id="appointment-time-slot"
                            name="appointment_time_slot_id"
                            required
                            disabled
                        >
                            <option value="">Select a date first</option>
                        </select>
                        @error('appointment_time_slot_id')
                            <p class="mt-1 text-sm text-error">{{ $message }}</p>
                        @enderror
                        <p id="appointment-slots-hint" class="mt-1 text-xs text-on-surface-variant"></p>
                    </div>
                </div>
                <div>
                    <label class="contact-label" for="appointment-customer-name">Full name</label>
                    <input
                        class="contact-input"
                        id="appointment-customer-name"
                        name="customer_name"
                        type="text"
                        value="{{ old('customer_name') }}"
                        placeholder="Your name"
                        required
                    />
                    @error('customer_name')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-5">
                    <div>
                        <label class="contact-label" for="appointment-customer-phone">Phone</label>
                        <input
                            class="contact-input"
                            id="appointment-customer-phone"
                            name="customer_phone"
                            type="tel"
                            value="{{ old('customer_phone') }}"
                            placeholder="(469) 000-0000"
                        />
                        @error('customer_phone')
                            <p class="mt-1 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="contact-label" for="appointment-customer-email">Email</label>
                        <input
                            class="contact-input"
                            id="appointment-customer-email"
                            name="customer_email"
                            type="email"
                            value="{{ old('customer_email') }}"
                            placeholder="example@domain.com"
                            required
                        />
                        @error('customer_email')
                            <p class="mt-1 text-sm text-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="contact-label" for="appointment-notes">Additional notes (optional)</label>
                    <textarea
                        class="contact-input resize-none"
                        id="appointment-notes"
                        name="notes"
                        rows="4"
                        placeholder="Tell us about your garage door or gate needs"
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end pt-1">
                    <button class="contact-btn" type="submit">Book appointment</button>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    var dateInput = document.getElementById('appointment-date');
    var slotSelect = document.getElementById('appointment-time-slot');
    var hint = document.getElementById('appointment-slots-hint');
    var slotsUrl = @json(route('contact.available-slots'));
    var oldSlotId = @json(old('appointment_time_slot_id'));

    if (!dateInput || !slotSelect) return;

    function setHint(text) {
        if (hint) hint.textContent = text || '';
    }

    function resetSlots(message) {
        slotSelect.innerHTML = '';
        var opt = document.createElement('option');
        opt.value = '';
        opt.textContent = message || 'Select a date first';
        slotSelect.appendChild(opt);
        slotSelect.disabled = true;
    }

    function loadSlots(date) {
        if (!date) {
            resetSlots('Select a date first');
            setHint('');
            return;
        }

        resetSlots('Loading…');
        setHint('');

        fetch(slotsUrl + '?date=' + encodeURIComponent(date), {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                var slots = data.slots || [];
                slotSelect.innerHTML = '';

                if (slots.length === 0) {
                    resetSlots('No times available');
                    setHint('Try another date or contact us by phone.');
                    return;
                }

                var placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = 'Select a time';
                slotSelect.appendChild(placeholder);

                slots.forEach(function (slot) {
                    var o = document.createElement('option');
                    o.value = slot.id;
                    var label = slot.label_en;
                    if (slot.remaining === 1) {
                        label += ' (1 spot left)';
                    }
                    o.textContent = label;
                    if (String(oldSlotId) === String(slot.id)) {
                        o.selected = true;
                    }
                    slotSelect.appendChild(o);
                });

                slotSelect.disabled = false;
            })
            .catch(function () {
                resetSlots('Could not load times');
                setHint('Please refresh the page or call us directly.');
            });
    }

    dateInput.addEventListener('change', function () {
        loadSlots(dateInput.value);
    });

    if (dateInput.value) {
        loadSlots(dateInput.value);
    } else {
        resetSlots('Select a date first');
    }
})();
</script>
@endpush
