@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <form class="custom-self-center mr-sm-3  my-2 my-lg-0 p-1" action="{{ route('users.create') }}">
                <input class="btn btn-primary" type="submit" value="{{__('buttons.create_user')}}"/>
            </form>
            <form method="GET" class=" my-2 my-lg-0 p-1">
                <select  class="custom-field" name="sort" id="sort" onchange="changeButtonText()">
                    <option selected disabled style="display:none">{{ __('fields.selection') }}</option>
                    <option value="name">{{ __('fields.name') }}</option>
                    <option value="role">{{ __('fields.role') }}</option>
                    <option value="email">{{ __('fields.email') }}</option>
                </select>
                <button class="btn btn-outline-success align-baseline" type="submit" id="filter-btn">{{ __('buttons.sort') }}</button>
            </form>
        </ul>
       <ul class="navbar-nav">
            <form method="GET"  role="search" class=" my-2 my-lg-0 p-1">
                <input  type="search" class="custom-field"
                    value="{{ isset($_GET['search_input']) ? $_GET['search_input'] : '' }}" aria-label="Search"
                    name="search_input">
                <button class="btn btn-outline-success align-baseline" type="submit" name="search">{{ __('buttons.search') }}</button>
            </form>
        </ul>


    </nav>
