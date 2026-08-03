<x-layout title="Portofolio - Elcoding Academy">

@push('styles')
    <link rel='stylesheet' id='elementor-post-10899-css' href='{{ asset("css/post-10899.css") }}' media='all' />
    <link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset("css/post-11887.css") }}' media='all' />
    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 40px 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .custom-pagination .page-numbers {
            font-size: 16px;
            font-weight: 500;
            color: #4B5563;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .custom-pagination .page-numbers:hover {
            color: #7C3AED;
        }
        .custom-pagination .page-numbers.current {
            color: #7C3AED;
        }
        .custom-pagination .dots {
            color: #4B5563;
        }
        .custom-pagination .elementor-screen-only {
            display: none;
        }
    </style>
    <style>
        /* Fix Hero Background Image */
        .elementor-element-691d17c::before {
            background-image: url('{{ asset("gambar/aset/Untitled-1.png") }}') !important;
            background-position: center center !important;
            background-size: cover !important;
            content: "" !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            z-index: 0 !important;
        }
        .elementor-element-691d17c > .e-con-inner {
            position: relative;
            z-index: 1;
        }

        /* Fix filter button colors to match the admin design */
        .e-filter-item {
            color: #333333 !important;
            background-color: transparent !important;
            border: none !important;
            outline: none !important;
            padding: 8px 16px !important;
            cursor: pointer;
            font-family: inherit;
            font-size: 1.1em;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .e-filter-item:hover {
            color: #2563EB !important;
        }
        .e-filter-item[aria-pressed="true"] {
            background-color: #2563EB !important;
            color: #ffffff !important;
        }

        .e-filter {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        @media (max-width: 768px) {
            .e-filter {
                justify-content: center;
            }
            .e-filter-item {
                font-size: 0.9em;
                padding: 6px 12px !important;
            }
        }
    </style>
@endpush

<!-- Hero Section -->
<div class="elementor elementor-11887">
    <div class="elementor-element elementor-element-691d17c hide-hero-if e-flex e-con-boxed e-con e-parent" data-id="691d17c" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="e-con-inner">
            <div class="elementor-element elementor-element-0b653e6 elementor-widget elementor-widget-heading" data-id="0b653e6" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
                <h1 class="elementor-heading-title elementor-size-default">Portofolio</h1>
            </div>
            <div class="elementor-element elementor-element-89b3de6 elementor-align-center elementor-widget elementor-widget-breadcrumbs" data-id="89b3de6" data-element_type="widget" data-e-type="widget" data-widget_type="breadcrumbs.default">
                <p id="breadcrumbs"><span><span><a href="{{ url('/') }}">Home</a></span> » <span class="breadcrumb_last" aria-current="page">Portofolio</span></span></p>
            </div>
        </div>
    </div>
</div>

<div data-elementor-type="archive" data-elementor-id="10899" class="elementor elementor-10899 elementor-location-archive" data-elementor-post-type="elementor_library">

		<div class="elementor-element elementor-element-ca56c8f e-con-full e-flex e-con e-parent" data-id="ca56c8f" data-element_type="container" data-e-type="container" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
		<div class="elementor-element elementor-element-635d385 e-con-full e-flex e-con e-child" data-id="635d385" data-element_type="container" data-e-type="container">
		<div class="elementor-element elementor-element-c2b2d44 e-con-full e-flex e-con e-child" data-id="c2b2d44" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;sticky&quot;:&quot;top&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;],&quot;sticky_offset&quot;:120,&quot;sticky_parent&quot;:&quot;yes&quot;,&quot;sticky_effects_offset&quot;:0,&quot;sticky_anchor_link_offset&quot;:0}" style="position: sticky; top: 120px; align-self: flex-start; z-index: 9;">
				<div class="elementor-element elementor-element-87c266d elementor-widget elementor-widget-heading" data-id="87c266d" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
					<p class="elementor-heading-title elementor-size-default">Filter</p>				</div>
				<div class="elementor-element elementor-element-241f494 elementor-widget elementor-widget-taxonomy-filter" data-id="241f494" data-element_type="widget" data-e-type="widget" data-settings="{&quot;selected_element&quot;:&quot;f14fd03&quot;,&quot;taxonomy&quot;:&quot;category-portofolio&quot;,&quot;item_alignment_horizontal_tablet&quot;:&quot;start&quot;,&quot;item_alignment_horizontal&quot;:&quot;start&quot;,&quot;horizontal_scroll&quot;:&quot;disable&quot;}" data-widget_type="taxonomy-filter.default">
							<search class="e-filter" role="search" data-base-url="#" data-page-num="1">
									<button class="e-filter-item" data-filter="__all" aria-pressed="true">
				All			</button>
							@php
								$categories = $portofolios->pluck('category')->unique();
							@endphp
							@foreach($categories as $category)
							<button class="e-filter-item" data-filter="{{ Str::slug($category) }}" aria-pressed="false">{{ $category }}</button>
							@endforeach
					</search>
						</div>
				</div>
				</div>
		<div class="elementor-element elementor-element-5ca4fd8 e-con-full e-flex e-con e-child" data-id="5ca4fd8" data-element_type="container" data-e-type="container">
				<div class="elementor-element elementor-element-f14fd03 elementor-grid-3 elementor-grid-mobile-1 elementor-grid-tablet-2 elementor-widget elementor-widget-loop-grid" data-id="f14fd03" data-element_type="widget" data-e-type="widget" data-settings="{&quot;template_id&quot;:&quot;9722&quot;,&quot;columns&quot;:3,&quot;row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:10,&quot;sizes&quot;:[]},&quot;columns_mobile&quot;:1,&quot;columns_tablet&quot;:2,&quot;pagination_type&quot;:&quot;numbers_and_prev_next&quot;,&quot;pagination_load_type&quot;:&quot;ajax&quot;,&quot;_skin&quot;:&quot;post&quot;,&quot;edit_handle_selector&quot;:&quot;[data-elementor-type=\&quot;loop-item\&quot;]&quot;,&quot;row_gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;row_gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="loop-grid.post">
				<div class="elementor-widget-container">
							<div class="elementor-loop-container elementor-grid" role="list">
		<style id="loop-9722">.elementor-9722 .elementor-element.elementor-element-944eda6{--display:flex;--gap:20px 20px;--row-gap:20px;--column-gap:20px;--background-transition:0.3s;border-style:solid;--border-style:solid;border-width:1px 1px 1px 1px;--border-top-width:1px;--border-right-width:1px;--border-bottom-width:1px;--border-left-width:1px;border-color:#C4C4C43B;--border-color:#C4C4C43B;--border-radius:15px 15px 15px 15px;--margin-top:0px;--margin-bottom:0px;--margin-left:0px;--margin-right:0px;}.elementor-9722 .elementor-element.elementor-element-944eda6:not(.elementor-motion-effects-element-type-background), .elementor-9722 .elementor-element.elementor-element-944eda6 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-color:var( --e-global-color-133101c );}.elementor-9722 .elementor-element.elementor-element-944eda6:hover{background-color:var( --e-global-color-549540e );}.elementor-9722 .elementor-element.elementor-element-7370c6a{--display:flex;--min-height:220px;--justify-content:center;--border-radius:15px 15px 0px 0px;--padding-top:0px;--padding-bottom:0px;--padding-left:0px;--padding-right:0px;}.elementor-9722 .elementor-element.elementor-element-7370c6a:not(.elementor-motion-effects-element-type-background), .elementor-9722 .elementor-element.elementor-element-7370c6a > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-position:center center;background-repeat:no-repeat;background-size:cover;}.elementor-9722 .elementor-element.elementor-element-81d6b82{--display:flex;--gap:10px 10px;--row-gap:10px;--column-gap:10px;--padding-top:0em;--padding-bottom:1em;--padding-left:0em;--padding-right:0em;}.elementor-widget-heading .elementor-heading-title{font-family:var( --e-global-typography-primary-font-family ), Sans-serif;font-size:var( --e-global-typography-primary-font-size );font-weight:var( --e-global-typography-primary-font-weight );color:var( --e-global-color-primary );}.elementor-9722 .elementor-element.elementor-element-26c85cc{text-align:center;}.elementor-9722 .elementor-element.elementor-element-26c85cc .elementor-heading-title{font-size:1.5em;font-weight:600;color:#000000;}.elementor-9722 .elementor-element.elementor-element-6845be9{text-align:center;}.elementor-9722 .elementor-element.elementor-element-6845be9 .elementor-heading-title{font-weight:500;color:var( --e-global-color-secondary );}@media(min-width:768px){.elementor-9722 .elementor-element.elementor-element-944eda6{--content-width:1200px;}.elementor-9722 .elementor-element.elementor-element-7370c6a{--content-width:1200px;}}@media(max-width:1024px){.elementor-widget-heading .elementor-heading-title{font-size:var( --e-global-typography-primary-font-size );}}@media(max-width:767px){.elementor-widget-heading .elementor-heading-title{font-size:var( --e-global-typography-primary-font-size );}}</style>		

        @foreach($portofolios as $portofolio)
        <div data-elementor-type="loop-item" data-elementor-id="9722" class="elementor elementor-9722 e-loop-item e-loop-item-{{ $portofolio->id }} post-{{ $portofolio->id }} portofolio type-portofolio status-publish has-post-thumbnail hentry category-portofolio-{{ Str::slug($portofolio->category) }}" data-elementor-post-type="elementor_library" data-custom-edit-handle="1">
			<a class="elementor-element elementor-element-944eda6 e-flex e-con-boxed e-con e-parent" data-id="944eda6" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" href="{{ url('/portofolio/' . $portofolio->id) }}">
					<div class="e-con-inner">
		<div class="elementor-element elementor-element-7370c6a e-flex e-con-boxed e-con e-child" data-id="7370c6a" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" style="background-image:url('{{ asset($portofolio->image_path ?? 'gambar/portofolio/Film-Islami-Kemenag.webp') }}');">
					<div class="e-con-inner">
					</div>
				</div>
		<div class="elementor-element elementor-element-81d6b82 e-flex e-con-boxed e-con e-child" data-id="81d6b82" data-element_type="container" data-e-type="container">
					<div class="e-con-inner">
				<div class="elementor-element elementor-element-26c85cc elementor-widget elementor-widget-heading" data-id="26c85cc" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
					<p class="elementor-heading-title elementor-size-default">{{ $portofolio->title }}</p>				</div>
				<div class="elementor-element elementor-element-6845be9 elementor-widget elementor-widget-heading" data-id="6845be9" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
					<p class="elementor-heading-title elementor-size-default">{{ $portofolio->category }}</p>				</div>
					</div>
				</div>
					</div>
				</a>
		</div>
        @endforeach
		</div>
		
				<div class="e-load-more-anchor" data-page="1" data-max-page="6" data-next-page="portofolio.php?e-page-f14fd03=2"></div>
            @if($portofolios->hasPages())
            <nav class="elementor-pagination custom-pagination" aria-label="Pagination">
                {{ $portofolios->links() }}
            </nav>
            @endif
				</div>
				</div>
				</div>
				</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.e-filter-item');
    const items = document.querySelectorAll('.e-loop-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            
            filterButtons.forEach(btn => btn.setAttribute('aria-pressed', 'false'));
            this.setAttribute('aria-pressed', 'true');
            
            const filterValue = this.getAttribute('data-filter');
            
            items.forEach(item => {
                if (filterValue === '__all') {
                    item.style.display = '';
                } else {
                    if (item.classList.contains('category-portofolio-' + filterValue)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>

</x-layout>