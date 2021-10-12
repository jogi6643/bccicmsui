<nav aria-label="..." class="paginations">
    <ul class="pagination right">
        @foreach ($data['link'] as $link)

            <li class="page-item {{ $link['active'] == 1 ? 'active' : '' }}">
                <a class="page-link" href="{{ url('/getAudioList') }}/{!! $link['label'] !!}">
                    {!! $link['label'] !!}
                </a>
            </li>

        @endforeach
    </ul>
</nav>

<div class="footer-tablelist">

     <form class="go-to-page" >
          <label class="go-to-page__label">Go to page</label>
          <div class="standardInput form-input" >
            <input class="go-to-page__input form-element go" id="go_to" type="number" name="go_to" min="1" max="64">
          </div>
          <button type="button" id="go"  class="go-to-page__link">
              <span data-i18n="pagination.go">Go</span>
              <span>›</span>
          </button>
    </form>
</div>
