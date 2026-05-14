@extends('menu')

@section('content')
<main>
<section class="relative min-h-[600px] flex items-center overflow-hidden bg-primary">
<div class="absolute inset-0 z-0">
<img alt="Professional garage door technician" class="w-full h-full object-cover" src="{{ asset('images/lifting-gates-garage.jpg') }}"/>
<div class="absolute inset-0 hero-overlay"></div>
</div>
<div class="relative z-10 max-w-screen-2xl mx-auto px-6 w-full grid grid-cols-1 md:grid-cols-2 items-center gap-12">
<div class="relative">
<div class="absolute -left-8 -top-8 w-24 h-24 border-l-8 border-t-8 border-slate-400 opacity-50"></div>
<h1 class="font-headline font-black text-4xl md:text-6xl text-white leading-tight mb-8">
                        Serving Your Home and Business <br/>
<span class="text-on-primary-container">One Door at a Time.</span>
</h1>
<p class="text-lg text-slate-200 font-light mb-10 max-w-lg">
                        Licensed, experienced, and ready to take care of any job — big or small. Twins Garage Doors LLC is your trusted local expert for garage door and gate installation, repair, and service — for homes and businesses of all sizes. Service area: DFW. English &amp; Spanish.
                    </p>
<div class="flex flex-wrap gap-4">
<a href="tel:+14692888881" class="inline-flex items-center justify-center bg-on-primary-container text-primary px-8 py-3 rounded font-headline font-bold text-lg hover:brightness-110 transition-all">
                            Call Us Today For a Free Quote
                        </a>
<button type="button" class="border border-white/30 text-white px-8 py-3 rounded font-headline font-bold text-lg hover:bg-white/10 transition-all" onclick="document.getElementById('servicios')?.scrollIntoView({behavior:'smooth'})">
                            Our Models
                        </button>
</div>
</div>
<div class="hidden md:flex justify-end">
<div class="relative w-80 h-96 bg-white/10 backdrop-blur-sm rounded-3xl overflow-hidden border border-white/20 p-4 shadow-2xl rotate-3 transform">
<img alt="Technician detail" class="w-full h-full object-cover rounded-2xl" src="{{ asset('images/instalacion-de-puertas-automaticas.jpg.webp') }}"/>
</div>
</div>
</div>
</section>
<section class="py-24 bg-[#f2f4f6] relative overflow-hidden" id="nosotros">
<svg class="house-outline-bg" fill="none" viewbox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
<path class="text-primary" d="M10 50L50 10L90 50V90H10V50Z" stroke="currentColor" stroke-width="2"></path>
<rect class="text-primary" height="30" stroke="currentColor" stroke-width="2" width="40" x="30" y="60"></rect>
</svg>
<div class="max-w-screen-2xl mx-auto px-6 relative z-10">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
<div class="lg:col-span-5">
<div class="relative rounded-br-[100px] overflow-hidden shadow-xl">
<img alt="Technicians with tablet" class="w-full h-auto object-cover" src="{{ asset('images/3.jpg') }}"/>
</div>
</div>
<div class="lg:col-span-7 lg:pl-12 flex flex-col items-start">
<div class="w-20 h-20 rounded-full border-2 border-primary flex items-center justify-center mb-6 bg-secondary-container">
<span class="material-symbols-outlined text-4xl text-primary" data-icon="engineering">engineering</span>
</div>
<h2 class="text-5xl md:text-6xl font-headline font-black text-primary mb-8 tracking-tight">
                            About<br/>Us
                        </h2>
<div class="space-y-6 text-on-surface-variant text-lg leading-relaxed max-w-2xl">
<p>
                                Twins Garage Doors LLC is a family-owned garage door and gate company serving residential and commercial customers. Built on hard work, honesty, and craftsmanship, we take pride in every installation, repair, and service call we handle. Our mission is to provide reliable, high-quality garage door and gate solutions with exceptional craftsmanship, honest service, and lasting value for every home and business we serve. Our vision is to be the most trusted name in garage door and gate services, known for innovation, integrity, and a commitment to enhancing security and convenience for our customers. Over 10 years of experience. Why choose us? Reliable &amp; experienced; fast &amp; dependable service; quality workmanship; customer satisfaction first; licensed &amp; insured.
                            </p>
<p>
                                Twins Garage Doors LLC was born from a simple idea — do the job right, treat every customer like family, and never cut corners. The name comes from the most important people in my life, my twin sisters. They are the heart and soul behind this company's name and a daily reminder of why I work as hard as I do. Building this business was never just about garage doors — it was about building something I could be proud of, something worthy of the family name. What started as a passion for craftsmanship grew into a full-service garage door and gate company serving both homeowners and businesses. From our very first installation to every commercial project we take on today, we've built our reputation one door at a time. Today, Twins Garage Doors LLC is proud to be a trusted name because we treat every job like it's our most important one. Because for us, it's not just business — it's family.
                            </p>
</div>
<div class="mt-10 flex flex-wrap items-center gap-8">
<a class="text-primary font-bold hover:underline flex items-center gap-2" href="mailto:twinsgaragedoors@gmail.com">
                                twinsgaragedoors@gmail.com
                            </a>
<span class="text-on-surface-variant font-medium">469-288-8881</span>
</div>
</div>
</div>
</div>
</section>
<section class="py-24 bg-[#1B365D]" id="servicios">
<div class="grid-container">
<div class="text-center mb-16">
<h2 class="text-6xl md:text-8xl font-headline font-black text-white uppercase mb-0 tracking-tight leading-none">
                        Services
                    </h2>
<p class="text-4xl md:text-5xl font-headline font-bold text-[#87A0CD] -mt-2">
                        you need
                    </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="bg-white rounded-[2rem] overflow-hidden flex flex-col h-full shadow-2xl relative">
<div class="relative h-64 overflow-hidden">
<img alt="Residential garage door" class="w-full h-full object-cover" src="{{ asset('images/service1.jpg') }}"/>
<div class="absolute bottom-0 right-0 w-20 h-20 bg-[#aec7f7] rounded-tl-[2rem] flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-4xl" data-icon="garage">garage</span>
</div>
</div>
<div class="p-8 flex flex-col flex-grow">
<h3 class="text-primary font-headline font-bold text-xl mb-4 leading-tight">
                                Garage Door Installation (Residential &amp; Commercial) — garage door replacement and new installations.
                            </h3>
<p class="text-on-surface-variant text-sm mb-8 flex-grow">
                                We install high-quality garage doors for homes and businesses, tailored to your style, security needs, and budget. From modern residential doors to heavy-duty commercial systems, we ensure a perfect fit and smooth operation. Benefits: improved security; curb appeal and value; smooth, quiet operation; energy-efficient options.
                            </p>
<div class="flex justify-between items-center mt-auto">
<a class="bg-primary text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-opacity-90 transition-all uppercase" href="#contacto">
                                    Read more
                                    <span class="material-symbols-outlined text-sm">double_arrow</span>
</a>
<div class="flex flex-col items-end opacity-70">
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Twins</span>
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Garage</span>
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Doors</span>
</div>
</div>
</div>
</div>
<div class="bg-white rounded-[2rem] overflow-hidden flex flex-col h-full shadow-2xl relative">
<div class="relative h-64 overflow-hidden">
<img alt="Garage door maintenance" class="w-full h-full object-cover" src="{{ asset('images/service2.jpg') }}"/>
<div class="absolute bottom-0 right-0 w-20 h-20 bg-[#aec7f7] rounded-tl-[2rem] flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-4xl" data-icon="construction">construction</span>
</div>
</div>
<div class="p-8 flex flex-col flex-grow">
<h3 class="text-primary font-headline font-bold text-xl mb-4 leading-tight">
                                Garage Door Repair &amp; Maintenance — broken springs and damaged doors.
                            </h3>
<p class="text-on-surface-variant text-sm mb-8 flex-grow">
                                From broken springs and damaged panels to malfunctioning openers, we provide fast and reliable repairs. Regular maintenance services help extend the life of your garage door and prevent costly breakdowns. Benefits: prevents costly future repairs; extends lifespan; keeps your family or business safe; fast service to minimize downtime.
                            </p>
<div class="flex justify-between items-center mt-auto">
<a class="bg-primary text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-opacity-90 transition-all uppercase" href="#contacto">
                                    Read more
                                    <span class="material-symbols-outlined text-sm">double_arrow</span>
</a>
<div class="flex flex-col items-end opacity-70">
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Twins</span>
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Garage</span>
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Doors</span>
</div>
</div>
</div>
</div>
<div class="bg-white rounded-[2rem] overflow-hidden flex flex-col h-full shadow-2xl relative">
<div class="relative h-64 overflow-hidden">
<img alt="Garage door repair" class="w-full h-full object-cover" src="{{ asset('images/service3.jpg') }}"/>
<div class="absolute bottom-0 right-0 w-20 h-20 bg-[#aec7f7] rounded-tl-[2rem] flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-4xl" data-icon="handyman">handyman</span>
</div>
</div>
<div class="p-8 flex flex-col flex-grow">
<h3 class="text-primary font-headline font-bold text-xl mb-4 leading-tight">
                                Gates &amp; Openers — installation, automation, repair, and smart upgrades.
                            </h3>
<p class="text-on-surface-variant text-sm mb-8 flex-grow">
                                Gate installation &amp; automation: we design and install secure, durable gates for residential and commercial properties, with automatic systems for access control. Gate &amp; garage door opener services: we install, repair, and upgrade openers for both garage doors and gates — quieter operation, smart access, and safer performance. Benefits include security, privacy, convenience, and long-term reliability.
                            </p>
<div class="flex justify-between items-center mt-auto">
<a class="bg-primary text-white px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 hover:bg-opacity-90 transition-all uppercase" href="#contacto">
                                    Read more
                                    <span class="material-symbols-outlined text-sm">double_arrow</span>
</a>
<div class="flex flex-col items-end opacity-70">
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Twins</span>
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Garage</span>
<span class="text-[10px] font-headline font-black text-primary leading-none uppercase">Doors</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="overflow-hidden" id="trabajo">
<div class="bg-[#87A0CD] py-20 px-6">
<div class="max-w-screen-2xl mx-auto">
<div class="mb-12">
<h2 class="text-primary font-headline font-black text-4xl md:text-5xl leading-none uppercase">Our</h2>
<h3 class="text-white font-headline font-black text-6xl md:text-8xl leading-none uppercase -mt-2">Work</h3>
<div class="mt-6 max-w-2xl flex flex-col md:flex-row md:items-end gap-6">
<p class="text-primary font-body font-medium leading-relaxed">
                                Project photos will be featured here — residential and commercial installs and repairs across DFW.
                            </p>
<a class="inline-flex items-center gap-2 bg-primary text-white px-6 py-2 rounded-full text-sm font-bold whitespace-nowrap hover:bg-opacity-90 transition-all uppercase" href="#contacto">
                                Read more <span class="material-symbols-outlined text-lg">double_arrow</span>
</a>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#1B365D] rounded-[3rem] p-4 lg:p-8">
<div class="lg:col-span-8 h-80 lg:h-[400px] overflow-hidden rounded-[2.5rem]">
<img alt="Our team at work" class="w-full h-full object-cover" src="{{ asset('images/lifting-gates-garage.jpg') }}"/>
</div>
<div class="lg:col-span-4 bg-white/10 backdrop-blur-md rounded-[2.5rem] p-8 flex flex-col justify-center gap-8">
<div>
<div class="text-white font-headline font-black text-5xl leading-tight">10+</div>
<div class="text-[#87A0CD] font-headline font-bold text-xl uppercase tracking-wider">Years of experience</div>
</div>
<div>
<div class="text-white font-headline font-black text-5xl leading-tight">100+</div>
<div class="text-[#87A0CD] font-headline font-bold text-xl uppercase tracking-wider">Projects completed</div>
</div>
<div>
<div class="text-white font-headline font-black text-5xl leading-tight">+100</div>
<div class="text-[#87A0CD] font-headline font-bold text-xl uppercase tracking-wider">Happy customers</div>
</div>
</div>
</div>
</div>
</div>
<div class="bg-white py-24 px-6 relative" id="reviews">
<div class="max-w-screen-2xl mx-auto">
<div class="text-center mb-16">
<h2 class="text-[#87A0CD] font-headline font-black text-4xl md:text-5xl leading-none uppercase">Our</h2>
<h3 class="text-primary font-headline font-black text-6xl md:text-8xl leading-none uppercase -mt-2">Experience</h3>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="bg-[#1B365D] rounded-[2.5rem] p-10 pt-16 relative shadow-xl">
<div class="absolute -top-6 left-8 bg-[#87A0CD] p-4 rounded-2xl">
<span class="material-symbols-outlined text-white text-5xl font-black rotate-180">format_quote</span>
</div>
<div class="absolute -top-10 right-8 w-20 h-20 rounded-full bg-white flex items-center justify-center border-4 border-[#1B365D]">
<span class="material-symbols-outlined text-4xl text-[#1B365D]">person_search</span>
</div>
<p class="text-white/80 text-sm leading-relaxed mb-8 italic">
                                "Fast response, fair pricing, and professional work on our new garage door. Highly recommend Twins Garage Doors in DFW."
                            </p>
<div class="flex gap-1">
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
</div>
</div>
<div class="bg-[#1B365D] rounded-[2.5rem] p-10 pt-16 relative shadow-xl">
<div class="absolute -top-6 left-8 bg-[#87A0CD] p-4 rounded-2xl">
<span class="material-symbols-outlined text-white text-5xl font-black rotate-180">format_quote</span>
</div>
<div class="absolute -top-10 right-8 w-20 h-20 rounded-full bg-white flex items-center justify-center border-4 border-[#1B365D]">
<span class="material-symbols-outlined text-4xl text-[#1B365D]">person_search</span>
</div>
<p class="text-white/80 text-sm leading-relaxed mb-8 italic">
                                "They fixed our broken spring quickly and explained everything clearly. Licensed, courteous, and dependable."
                            </p>
<div class="flex gap-1">
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
</div>
</div>
<div class="bg-[#1B365D] rounded-[2.5rem] p-10 pt-16 relative shadow-xl">
<div class="absolute -top-6 left-8 bg-[#87A0CD] p-4 rounded-2xl">
<span class="material-symbols-outlined text-white text-5xl font-black rotate-180">format_quote</span>
</div>
<div class="absolute -top-10 right-8 w-20 h-20 rounded-full bg-white flex items-center justify-center border-4 border-[#1B365D]">
<span class="material-symbols-outlined text-4xl text-[#1B365D]">person_search</span>
</div>
<p class="text-white/80 text-sm leading-relaxed mb-8 italic">
                                "Our automatic gate and opener upgrade was seamless. Quiet, secure, and great communication from start to finish."
                            </p>
<div class="flex gap-1">
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
<span class="material-symbols-outlined text-yellow-400 fill-current">star</span>
</div>
</div>
</div>
<div class="flex justify-center gap-2 mt-12">
<div class="w-3 h-3 rounded-full bg-[#87A0CD]"></div>
<div class="w-3 h-3 rounded-full bg-[#87A0CD]/40"></div>
<div class="w-3 h-3 rounded-full bg-[#87A0CD]/40"></div>
<div class="w-3 h-3 rounded-full bg-[#87A0CD]/40"></div>
<div class="w-3 h-3 rounded-full bg-[#87A0CD]/40"></div>
<div class="w-3 h-3 rounded-full bg-[#87A0CD]/40"></div>
</div>
</div>
</div>
</section>
<section class="bg-[#A5C2F1] py-16 px-6" id="contacto">
<div class="max-w-6xl mx-auto">
<div class="flex flex-col md:flex-row items-stretch gap-12">
<div class="w-full md:w-1/2 flex flex-col">
<div class="mb-8 flex items-center gap-3">
<div class="w-12 h-10 bg-white rounded-md flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-3xl font-black">garage</span>
</div>
<div class="flex flex-col leading-none">
<span class="text-primary font-headline font-black text-xl uppercase">Twins Garage</span>
<span class="text-primary font-headline font-black text-xl uppercase">Doors LLC</span>
</div>
</div>
<h2 class="text-[#002046] font-headline font-black text-4xl mb-8">Contact Us</h2>
<form class="space-y-4">
<div class="bg-white rounded-xl p-4 shadow-sm">
<label class="block text-primary font-bold mb-1 text-sm" for="correo">Email</label>
<input class="w-full border-none p-0 focus:ring-0 text-on-surface-variant placeholder:text-slate-300" id="correo" placeholder="twinsgaragedoors@gmail.com" type="email"/>
</div>
<div class="bg-white rounded-xl p-4 shadow-sm">
<label class="block text-primary font-bold mb-1 text-sm" for="mensaje">Message</label>
<textarea class="w-full border-none p-0 focus:ring-0 text-on-surface-variant placeholder:text-slate-300 min-h-[120px]" id="mensaje" placeholder="Write your message here..."></textarea>
</div>
<div class="flex justify-end pt-2">
<button class="bg-[#1B365D] text-white px-10 py-3 rounded-full font-headline font-bold text-sm tracking-widest hover:brightness-110 transition-all shadow-md uppercase">
                                    Send
                                </button>
</div>
</form>
<div class="mt-12 space-y-4">
<div class="flex items-center gap-3 text-primary font-bold">
<div class="w-8 h-8 rounded-full border-2 border-primary flex items-center justify-center">
<span class="material-symbols-outlined text-lg">call</span>
</div>
<span>469-288-8881</span>
</div>
<div class="flex items-center gap-3 text-primary font-bold">
<div class="w-8 h-8 rounded-full border-2 border-primary flex items-center justify-center">
<span class="material-symbols-outlined text-lg">mail</span>
</div>
<span>twinsgaragedoors@gmail.com</span>
</div>
</div>
</div>
<div class="w-full md:w-1/2 min-h-[400px]">
<div class="h-full w-full rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white/20">
<iframe allowfullscreen="" height="100%" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://maps.google.com/maps?q=Dallas-Fort%20Worth%2C%20TX&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=&amp;output=embed" style="border:0;" width="100%">
</iframe>
</div>
</div>
</div>
<div class="mt-16 pt-8 border-t border-primary/10 flex flex-col md:flex-row justify-between items-center gap-6">
<div class="flex items-center gap-6">
<span class="text-primary font-bold text-sm uppercase tracking-widest">Follow us</span>
<div class="flex gap-4">
<a class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white hover:scale-110 transition-transform" href="https://www.instagram.com/TwinsGarageDoors/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
<svg class="w-4 h-4" fill="currentColor" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
</a>
<a class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white hover:scale-110 transition-transform" href="#" aria-label="Facebook">
<svg class="w-4 h-4" fill="currentColor" viewbox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
</a>
</div>
</div>
</div>
</div>
</section>
</main>
@endsection
