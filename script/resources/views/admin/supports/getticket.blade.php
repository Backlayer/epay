
    <form action="{{ route('admin.supports.update-status', ['support' => $support->id, 'trigger' => 'trigger-'.$support->id]) }}" method="post" class="ajaxform_with_redirect_without_validation">
        @csrf

        <div class="row align-items-center">
            <div class="col-md-6">
                @if($support->status)
                    <span class="badge badge-success">
                    <i class="fas fa-check-circle"></i>
                    {{ __('Open') }}
                @else
                    <span class="badge badge-danger">
                    <i class="fas fa-times-circle"></i>
                    {{ __('Closed') }}
                </span>
                @endif
            </div>
            <div class="col-md-6">
                <select name="status" id="status">
                    <option value="0" @selected($support->status == 0)>{{ __('Closed') }}</option>
                    <option value="1" @selected($support->status == 1)>{{ __('Active') }}</option>
                </select>
            </div>
        </div>
    </form>
    <div class="ticket-divider"></div>
<div class="overflow-auto comments" style="max-height: 500px">
    @foreach($meta as $item)
        <div class="ticket-header">
            <div class="ticket-sender-picture img-shadow">
                <img src="{{ get_gravatar($item->repliedBy->email) }}" alt="{{ $item->repliedBy->name }}">
            </div>
            <div class="ticket-detail">
                <div class="ticket-title">
                    <h4>{{ $item->repliedBy->name }}</h4>
                </div>
                <div class="ticket-info">
                    <div class="text-primary font-weight-600">{{ $item->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>
        <div class="ticket-description">
            {{ $item->comment }}

            @if(!$loop->last)
            <div class="ticket-divider"></div>
            @endif
        </div>
    @endforeach
</div>

@if($support->status)
    <div class="ticket-description">
        <div class="ticket-form">
            <form action="{{ route('admin.supports.reply', ['support' => $support->id, 'trigger' => 'trigger-'.$support->id]) }}" method="post" class="ajaxform_with_redirect_without_validation">
                @csrf
                <div class="form-group">
                    <label for="comment" class="required">{{ __('Comment') }}</label>
                    <textarea name="comment" id="comment" class="summernote form-control" placeholder="Type a reply ..."></textarea>
                </div>

                <div class="form-group text-right">
                    <button class="btn btn-primary btn-lg basicbtn">
                        {{ __('Reply') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

<script>
    "use strict";
    $('#status').select2();
    $('.comments').animate({ scrollTop: 9999 }, 'slow');
    $(document).on('change', '#status', function () {
        $(this).trigger('submit');
    })
</script>
