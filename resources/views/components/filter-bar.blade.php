@props(['active' => null])

<div class="filter-tabs-wrapper">
    <div class="filter-tabs">
        <a href="{{ url('/program-kursus') }}" class="tab-pill {{ $active === 'program-kursus' || request()->is('program-kursus') ? 'active' : '' }}">Semua Program</a>
        <a href="{{ url('/event-webinar') }}" class="tab-pill {{ $active === 'event-webinar' || request()->is('event-webinar') ? 'active' : '' }}">Semua Event</a>
        <a href="{{ url('/bootcamp-intensif') }}" class="tab-pill {{ $active === 'bootcamp-intensif' || request()->is('bootcamp-intensif') ? 'active' : '' }}">Bootcamp Intensif</a>
        <a href="{{ url('/webinar-tech') }}" class="tab-pill {{ $active === 'webinar-tech' || request()->is('webinar-tech') ? 'active' : '' }}">Webinar Tech</a>
        <a href="{{ url('/workshop-online') }}" class="tab-pill {{ $active === 'workshop-online' || request()->is('workshop-online') ? 'active' : '' }}">Workshop Online</a>
    </div>
</div>
