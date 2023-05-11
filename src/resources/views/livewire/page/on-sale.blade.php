@section("title", "On Sale | LEVEL-UP")

<div class="container">
    <div class="row">
        <div class="col-md-3 sticky-parent">
            <div class="sticky">
                @livewire("page.partial.filter")
            </div>
        </div>
        <div class="col-md-9">
            <div class="section" id="latest-arrivals">
                <div class="section-header">
                    <h4>On Sale</h4>
                </div>
                @livewire("page.partial.latest-arrivals", ["row_size" => "4", "filters" => ["on_sale" => true], "paginate" => true])
            </div>
        </div>
    </div>
</div>
