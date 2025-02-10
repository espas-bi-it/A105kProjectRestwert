@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <form method="GET" class="form-inline my-2 my-lg-0 p-1 ">
                <select class="form-control mr-sm-2  pr-5" name="sort" id="sort" onchange="changeButtonText()">
                    <option selected disabled style="display:none">{{ __('fields.selection') }}</option>
                    <option value="incorporated">{{ __('fields.incorporated') }}</option>
                    <option value="name">{{ __('fields.name') }}</option>
                    <option value="surname">{{ __('fields.surname') }}</option>
                    <option value="city">{{ __('fields.city') }}</option>
                    <option value="created_at">{{ __('fields.created_at') }}</option>
                </select>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="filter-btn">{{ __('buttons.sort') }}</button>
            </form>
        </ul>
        <ul>
            <form method="GET" class="form-inline my-2 my-lg-0" role="search">
                <input class="form-control mr-sm-2 custom-field" type="search"
                    value="{{ isset($_GET['search_input']) ? $_GET['search_input'] : '' }}" aria-label="Search"
                    name="search_input">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">{{ __('buttons.search') }}</button>
            </form>
        </ul>
    </nav>

    <script>
        function changeButtonText() {
            var x = document.getElementById("sort").value;
            if (x == "incorporated") {
                document.getElementById("filter-btn").innerHTML = "Filter";
            } else {
                document.getElementById("filter-btn").innerHTML = "{{ __('buttons.sort') }}";
            }
        }
    </script>
