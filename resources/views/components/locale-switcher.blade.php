<form method="GET">
    <select id="language-switcher" onchange="window.location.href=this.value;">
        <option value="{{ route('locale.switch', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
             {{ __('fields.english') }}
        </option>
        <option value="{{ route('locale.switch', 'de') }}" {{ app()->getLocale() == 'de' ? 'selected' : '' }}>
             {{ __('fields.german') }}
        </option>
        <option value="{{ route('locale.switch', 'fr') }}" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>
             {{ __('fields.french') }}
        </option>
    </select>
</form>
