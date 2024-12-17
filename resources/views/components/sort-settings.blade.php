@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <form action="{{ route('users.create') }}" class="form-inline">
                <input class="btn btn-outline-secondary" type="submit" value="+"/>
            </form>
            <form method="GET" class="form-inline my-5 my-lg-0 p-1 ">
                <select class="form-control mr-sm-2  pr-5" name="sort" id="sort" onchange="changeButtonText()">
                    <option selected disabled style="display:none">{{ __('fields.selection') }}</option>
                    <option value="name">{{ __('fields.name') }}</option>
                    <option value="role">{{ __('fields.role') }}</option>
                    <option value="email">{{ __('fields.email') }}</option>
                </select>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="filter-btn">{{ __('buttons.sort') }}</button>
            </form>
        </ul>
        <ul>
            <form method="GET" class="form-inline my-2 my-lg-0" role="search">
                <input class="form-control mr-sm-2" type="search"
                    value="{{ isset($_GET['search_input']) ? $_GET['search_input'] : '' }}" aria-label="Search"
                    name="search_input">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">{{ __('buttons.search') }}</button>
            </form>
        </ul>
    </nav>
