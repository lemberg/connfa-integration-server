<div class="col-md-3 col-xs-12 widget widget_tally_box">
    <div class="x_panel fixed_height_390">
        <div class="x_content">
            <div class="flex">
                <ul class="list-inline widget_profile_box">
                    <li>
                        @if($speaker->website)
                            <a href="{{ $speaker->website }}">
                                <i class="fa fa-external-link"></i>
                            </a>
                        @endif
                    </li>
                    <li>
                        {{ Html::image(empty($speaker->avatar) ? '/assets/images/user.png' : $speaker->avatar, $speaker->fullname, ['class' => 'img-circle profile_img']) }}
                    </li>
                    <li>
                        @if($speaker->twitter_name)
                            <a href="https://twitter.com/{{ $speaker->twitter_name }}" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
            <a href="{{ route('speakers.show', ['id' => $speaker->id]) }}">
                <h4 class="name">{{ $speaker->fullname }}</h4>
            </a>
            <div class="flex">
                <ul class="list-inline count2">
                    {{ Html::email(empty($speaker->email) ? 'no email' : $speaker->email) }}
                </ul>
            </div>
            <p>
                {{ str_limit(strip_tags($speaker->characteristic), 250) }}
            </p>
        </div>
    </div>
</div>