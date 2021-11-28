
<!-- Modal -->
<div class="modal fade" id="{{ isset($name) ? $name : 'modalComponent' }}" tabindex="-1" aria-labelledby="{{ isset($name) ? $name : 'modalComponent' }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ isset($name) ? $name : 'modalComponent' }}Label">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ isset($action) ? $action : '' }}" method="{{ isset($method) ? $method : '' }}">
        @csrf
          <div class="modal-body">
          {{ $slot }}
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-{{ isset($closeButtonColorClass) ? $closeButtonColorClass : 'secondary' }}" data-dismiss="modal">{{ $closeButton }}</button>
              @if ($okButton != 'false')
              <button type="submit" class="btn btn-{{ isset($okButtonColorClass) ? $okButtonColorClass : 'primary' }}">{{ $okButton }}</button>
              @endif
          </div>
      </form>
    </div>
  </div>
</div>
  