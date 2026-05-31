<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSetting;
use App\Models\AppointmentTimeSlot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentSlotController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('appointments.settings');
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('appointments.settings');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'start_time' => ['required', 'date_format:H:i'],
            'capacity' => ['required', 'integer', 'min:1', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $maxOrder = AppointmentTimeSlot::query()->max('sort_order');
        $startTime = $validated['start_time'].':00';

        AppointmentTimeSlot::query()->create([
            'label_en' => AppointmentTimeSlot::labelFromStartTime($startTime),
            'start_time' => $startTime,
            'capacity' => $validated['capacity'],
            'sort_order' => $validated['sort_order'] ?? (($maxOrder ?? 0) + 1),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('appointments.settings')
            ->with('success', 'Time slot created.');
    }

    public function edit(AppointmentTimeSlot $slot): RedirectResponse
    {
        return redirect()->route('appointments.settings');
    }

    public function update(Request $request, AppointmentTimeSlot $slot): RedirectResponse
    {
        $validated = $request->validate([
            'start_time' => ['required', 'date_format:H:i'],
            'capacity' => ['required', 'integer', 'min:1', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $startTime = $validated['start_time'].':00';

        $slot->update([
            'label_en' => AppointmentTimeSlot::labelFromStartTime($startTime),
            'start_time' => $startTime,
            'capacity' => $validated['capacity'],
            'sort_order' => $validated['sort_order'] ?? $slot->sort_order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('appointments.settings')
            ->with('success', 'Time slot updated.');
    }

    public function destroy(AppointmentTimeSlot $slot): RedirectResponse
    {
        $slot->delete();

        return redirect()
            ->route('appointments.settings')
            ->with('success', 'Time slot deleted.');
    }
}
