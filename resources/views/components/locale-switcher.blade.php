<div class="custom-ellipsis-nav">
    <form id="language-form" method="GET" action="">
            <!-- English Button -->
            <button type="button" onclick="setLanguageAction('en')">
                <img src="{{ asset('image/english.png') }}" 
                     alt="English Flag" 
                     {{ app()->getLocale() == 'en' ? 'class=img-selected' : 'class=img-flag' }}>
            </button>

            <!-- German Button -->
            <button type="button" onclick="setLanguageAction('de')">
                <img src="{{ asset('image/german.png') }}" 
                     alt="German Flag" 
                     {{ app()->getLocale() == 'de' ? 'class=img-selected' : 'class=img-flag' }}>
            </button>

            <!-- French Button -->
            <button type="button" onclick="setLanguageAction('fr')">
                <img src="{{ asset('image/french.png') }}" 
                     alt="French Flag" 
                     {{ app()->getLocale() == 'fr' ? 'class=img-selected' : 'class=img-flag' }}>
            </button>
    </form>
</div>

<script>
    function setLanguageAction(language) {
        const form = document.getElementById('language-form');
        // Update the form's action dynamically
        form.action = `{{ url('locale/') }}/${language}`;
        form.submit();
    }
</script>
