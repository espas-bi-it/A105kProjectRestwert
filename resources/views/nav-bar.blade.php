@vite(['resources/css/app.css', 'resources/js/app.js'])
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav mr-auto">
            <form method="GET" class="form-inline my-2 my-lg-0 p-1 ">
                <select class="form-control mr-sm-2  pr-5" name="sort" id="sort" onchange="changeButtonText()">
                    <option selected disabled>Bitte auswählen</option>
                    <option value="incorporated">Eingetragen</option>
                    <option value="name">Vorname</option>
                    <option value="surname">Name</option>
                    <option value="zip">PLZ</option>
                </select>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" id="filter-btn">Sortieren</button>
            </form>
        </ul>
        <ul>
            <form method="GET" class="form-inline my-2 my-lg-0" role="search">
                <input class="form-control mr-sm-2" type="search" placeholder="Suchen"
                    value="{{ isset($_GET['search_input']) ? $_GET['search_input'] : '' }}" aria-label="Search"
                    name="search_input">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Suchen</button>
            </form>
        </ul>
    </nav>

    <script>
        function changeButtonText() {
            var x = document.getElementById("sort").value;
            if (x == "incorporated") {
                document.getElementById("filter-btn").innerHTML = "Filtern";
            } else {
                document.getElementById("filter-btn").innerHTML = "Sortieren";
            }
        }
    </script>
