

@if($content_type=='articles')
<nav aria-label="..." class="paginations">
            <ul class="pagination right">
                @foreach($pagination as $link)
                
                    @if($content_type=='articles')
                    <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                        <a class="page-link" href="{{url($content_type)}}/{!! $link['label'] !!}">
                            {!! $link['label'] !!}
                        </a>
                    </li>
                    @else
                    <li class="page-item {{($link['active'] == 1 ? 'active' : '')}}">
                        <a class="page-link" href="{{url($content_type)}}/{!! $link['label'] !!}">
                            {!! $link['label'] !!}
                        </a>
                    </li>
                    @endif

                @endforeach
            </ul>
</nav>
@else
<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item disabled">
            <span class="page-link">Previous</span>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active">
              <span class="page-link">
                2
                <span class="sr-only">(current)</span>
              </span>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>
@endif

<div class="footer-tablelist" >
  
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
