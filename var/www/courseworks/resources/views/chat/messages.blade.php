<x-admin-layout>
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >

            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Сообщения</h3>

                <!-- Breadcrumbs -->
{{--                <nav id="breadcrumbs" class="dark">--}}
{{--                    <ul>--}}
{{--                        <li><a href="#">Home</a></li>--}}
{{--                        <li><a href="#">Dashboard</a></li>--}}
{{--                        <li>Messages</li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
            </div>

            <div class="messages-container margin-top-0">

                <div class="messages-container-inner">

                    <!-- Messages -->
                    <div class="messages-inbox">
                        <div class="messages-headline">
                            <div class="input-with-icon">
                                <input id="autocomplete-input" type="text" placeholder="Search">
                                <i class="icon-material-outline-search"></i>
                            </div>
                        </div>

                        <ul>
                            @foreach($threads as $thread)
                                <li @if(!$thread->read_at && $thread->content) style="background: antiquewhite;" @endif>
                                    <a href="#" data-chat-id="{{ $thread->thread_uuid }}">
{{--                                        <div class="message-avatar"><i class="status-icon status-offline"></i><img src="images/user-avatar-small-02.jpg" alt="" /></div>--}}

                                        <div class="message-by">
                                            <div class="message-by-headline">
                                                <h5>{{ $thread->user_name }}</h5>
                                                <span>{{ $thread->created_at }}</span>
                                            </div>
                                            <p>{{ $thread->content }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Messages / End -->

                    <!-- Message Content -->
                    <div class="message-content">

                        <div class="messages-headline">
                            <h4>Sindy Forest</h4>
                            <a href="#" class="message-action"><i class="icon-feather-trash-2"></i> Delete Conversation</a>
                        </div>

                        <!-- Message Content Inner -->
                        <div id="messages" class="message-content-inner">

                            <!-- Time Sign -->
{{--                            <div class="message-time-sign">--}}
{{--                                <span>28 June, 2018</span>--}}
{{--                            </div>--}}


                            <!-- Time Sign -->
{{--                            <div class="message-time-sign">--}}
{{--                                <span>Yesterday</span>--}}
{{--                            </div>--}}



{{--                            <div class="message-bubble">--}}
{{--                                <div class="message-bubble-inner">--}}
{{--                                    <div class="message-avatar"><img src="images/user-avatar-small-02.jpg" alt="" /></div>--}}
{{--                                    <div class="message-text">--}}
{{--                                        <!-- Typing Indicator -->--}}
{{--                                        <div class="typing-indicator">--}}
{{--                                            <span></span>--}}
{{--                                            <span></span>--}}
{{--                                            <span></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="clearfix"></div>--}}
{{--                            </div>--}}
                        </div>
                        <!-- Message Content Inner / End -->

                        <!-- Reply Area -->
                        <div class="message-reply">
                            <textarea cols="1" rows="1" id="message" placeholder="Введите сообщение" data-autoresize></textarea>
                            <button id="send-message" class="button ripple-effect">Отправить</button>
                        </div>

                    </div>
                    <!-- Message Content -->

                </div>
            </div>
            <!-- Messages Container / End -->




            <!-- Footer -->
            <div class="dashboard-footer-spacer"></div>
            <div class="small-footer margin-top-15">
                <div class="small-footer-copyrights">
                    © 2018 <strong>Hireo</strong>. All Rights Reserved.
                </div>
                <ul class="footer-social-links">
                    <li>
                        <a href="#" title="Facebook" data-tippy-placement="top">
                            <i class="icon-brand-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Twitter" data-tippy-placement="top">
                            <i class="icon-brand-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Google Plus" data-tippy-placement="top">
                            <i class="icon-brand-google-plus-g"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="LinkedIn" data-tippy-placement="top">
                            <i class="icon-brand-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Footer / End -->

        </div>
    </div>
    @section('scripts')
        <script>
            let userId = {{ Auth::user()->id }};
            window.threadId = '';
        </script>
    @endsection
</x-admin-layout>
