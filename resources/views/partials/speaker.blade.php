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
                    <li class="dash-profile-img-wrapper">
                        @if(empty($speaker->avatar))
                            {{ Html::image('/assets/images/user.png', $speaker->fullname, ['width' => 85, 'height' => 85, 'class' => 'img-circle dash-circle-profile-img']) }}
                        @else
                            <?php
                            try {
                                list($width, $height, $type, $attr) = getimagesize($speaker->avatar);
                                $class = '';

                                if ($width < $height) {
                                    $class = 'dash-circle-profile-img-height';
                                }
                                $real_image = true;
                            } catch (\Exception $e) {
                                $real_image = false;
                            }
                            ?>
                            @if ($real_image)
                                {{ Html::image($speaker->avatar, $speaker->fullname, ['width' => 85, 'height' => 85, 'class' => "img-circle dash-circle-profile-img $class"]) }}
                            @else
                                {{ Html::image('/assets/images/user.png', $speaker->fullname, ['width' => 85, 'height' => 85, 'class' => 'img-circle dash-circle-profile-img']) }}
                            @endif
                        @endif
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
            <a href="{{ route('speakers.show', ['id' => $speaker->id, 'conference_alias' => $conference->alias]) }}">
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
