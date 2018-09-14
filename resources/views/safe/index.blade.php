@extends('safe.layout')
@section('main')
    <div style="display: block;height: 0;width: 0; overflow: hidden; ">
    </div>
    <!-- <div class="text-wrapper">Advertorial content</div> -->
    <div class="section">
        <div class="w-container">
            <img class="logo" sizes="200px" src="./tesler_files/images/logo.png">
            <h1 class="title">Earn Up to $237 per hour Starting Today
                <span id="dayOfWeek"></span>
                <span id="dayOfWeekNum"></span>
                <span id="month"></span>
                <br> Just by Testing This Software for 5 Minutes</h1>
            <div class="clear"></div>
            <div class="w-row">
                <div class="w-col w-col-8">
                    <div class="video embed-responsive embed-responsive-16by9">
                        <div id="videoHome1" class="embed-responsive-item">
                            <link href="./tesler_files/style/video-js.min.css" rel="stylesheet">
                            <!--                            <script src="./tesler_files/script/video.min.js"></script>-->
                            <style>
                                div.video-js {
                                    position: relative;
                                    padding-top: 0px;
                                    height: 0;
                                    direction: ltr;
                                    width: 100%;
                                    margin: auto;
                                }

                                div.video-js video {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                }

                                .video-js .vjs-control-bar {
                                    display: none;
                                    visibility: hidden;
                                    opacity: 0;
                                    pointer-events: none;
                                }
                            </style>
                            <style>
                                div.video-js#step1 {
                                    padding-bottom: 56.603773584906%;
                                }
                            </style>
                            <!-- Video for the-tesler >> step1 -->
                            <div tabindex="-1" poster="" preload="auto" autoplay="true" data-video-num="1" class="video-js vjs-default-skin vjs-big-play-centered funnel-video step1-dimensions vjs-controls-enabled vjs-workinghover vjs-has-started vjs-paused vjs-user-inactive"
                                 id="step1" lang="en" role="region" aria-label="Video Player">
                                <video id="step1_html5_api" class="vjs-tech" data-video-num="1" autoplay preload="auto" poster=""
                                       tabindex="-1" src="./tesler_files/video/video_main.mp4">

                                    <source src="./tesler_files/video/video_main.mp4" type="video/mp4">
                                    <p class="vjs-no-js">
                                        To view this video please enable JavaScript, and consider upgrading to a web browser that
                                        <a
                                                href="http://videojs.com/html5-video-support/" target="_blank" class="vjs-hidden"
                                                hidden="hidden">supports HTML5 video</a>
                                    </p>
                                </video>
                                <script>
                                    $(document).ready(function () {
                                        $('#step1_html5_api').click(function () {
                                            this.paused ? this.play() : this.pause();
                                        })
                                    });
                                </script>
                                <div class="vjs-poster" tabindex="-1" aria-disabled="false" style="background-image: url(&quot;https://brxfinance.com/cmpn/the-tesler-adv/?link=19561&amp;subc=wIIOQQBL3OPVM9EE1AT9SI9K&amp;utm_medium=3364842922&amp;utm_campaign=19fbbf7c-dece-40c3-a32b-71b2d224c3c5&quot;);"></div>
                                <div class="vjs-text-track-display" aria-live="off" aria-atomic="true"></div>
                                <div class="vjs-loading-spinner" dir="ltr"></div>
                                <button class="vjs-big-play-button" type="button" aria-live="polite" title="Play Video"
                                        aria-disabled="false">
                                    <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                    <span class="vjs-control-text">Play Video</span>
                                </button>
                                <div class="vjs-control-bar" dir="ltr" role="group">
                                    <button class="vjs-play-control vjs-control vjs-button vjs-paused" type="button" aria-live="polite"
                                            title="Play" aria-disabled="false">
                                        <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                        <span class="vjs-control-text">Play</span>
                                    </button>
                                    <div class="vjs-volume-panel vjs-control vjs-volume-panel-horizontal">
                                        <button class="vjs-mute-control vjs-control vjs-button vjs-vol-3" type="button" aria-live="polite"
                                                title="Mute" aria-disabled="false">
                                            <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                            <span class="vjs-control-text">Mute</span>
                                        </button>
                                        <div class="vjs-volume-control vjs-control vjs-volume-horizontal">
                                            <div tabindex="0" class="vjs-volume-bar vjs-slider-bar vjs-slider vjs-slider-horizontal" role="slider" aria-valuenow="100"
                                                 aria-valuemin="0" aria-valuemax="100" aria-label="Volume Level" aria-live="polite"
                                                 aria-valuetext="100%">
                                                <div class="vjs-volume-level">
                                                    <span class="vjs-control-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vjs-current-time vjs-time-control vjs-control">
                                        <div class="vjs-current-time-display" aria-live="off">
                                            <span class="vjs-control-text">Current Time</span> 01:21
                                        </div>
                                    </div>
                                    <div class="vjs-time-control vjs-time-divider">
                                        <div>
                                            <span>/</span>
                                        </div>
                                    </div>
                                    <div class="vjs-duration vjs-time-control vjs-control">
                                        <div class="vjs-duration-display" aria-live="off">
                                            <span class="vjs-control-text">Duration Time</span> 33:14
                                        </div>
                                    </div>
                                    <div class="vjs-progress-control vjs-control">
                                        <div tabindex="0" class="vjs-progress-holder vjs-slider vjs-slider-horizontal" role="slider" aria-valuenow="4.11" aria-valuemin="0"
                                             aria-valuemax="100" aria-label="Progress Bar" aria-valuetext="01:21 of 33:14">
                                            <div class="vjs-load-progress" style="width: 7.78096%;">
                                                <span class="vjs-control-text">
                                                    <span>Loaded</span>: 0%</span>
                                                <div style="left: 0%; width: 100%;"></div>
                                            </div>
                                            <div class="vjs-mouse-display">
                                                <div class="vjs-time-tooltip"></div>
                                            </div>
                                            <div class="vjs-play-progress vjs-slider-bar" style="width: 4.11%;">
                                                <div class="vjs-time-tooltip">01:21</div>
                                                <span class="vjs-control-text">
                                                    <span>Progress</span>: 0%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="vjs-live-control vjs-control vjs-hidden">
                                        <div class="vjs-live-display" aria-live="off">
                                            <span class="vjs-control-text">Stream Type</span>LIVE
                                        </div>
                                    </div>
                                    <div class="vjs-remaining-time vjs-time-control vjs-control">
                                        <div class="vjs-remaining-time-display" aria-live="off">
                                            <span class="vjs-control-text">Remaining Time</span> -31:52
                                        </div>
                                    </div>
                                    <div class="vjs-custom-control-spacer vjs-spacer ">&nbsp;</div>
                                    <div class="vjs-playback-rate vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden">
                                        <button class="vjs-playback-rate vjs-menu-button vjs-menu-button-popup vjs-button" type="button"
                                                aria-live="polite" aria-disabled="false" title="Playback Rate" aria-haspopup="true"
                                                aria-expanded="false">
                                            <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                            <span class="vjs-control-text">Playback Rate</span>
                                        </button>
                                        <div class="vjs-menu">
                                            <ul class="vjs-menu-content" role="menu"></ul>
                                        </div>
                                        <div class="vjs-playback-rate-value">1</div>
                                    </div>
                                    <div class="vjs-chapters-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden">
                                        <button class="vjs-chapters-button vjs-menu-button vjs-menu-button-popup vjs-button"
                                                type="button" aria-live="polite" aria-disabled="false" title="Chapters" aria-haspopup="true"
                                                aria-expanded="false">
                                            <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                            <span class="vjs-control-text">Chapters</span>
                                        </button>
                                        <div class="vjs-menu">
                                            <ul class="vjs-menu-content" role="menu">
                                                <li class="vjs-menu-title" tabindex="-1">Chapters</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="vjs-descriptions-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden">
                                        <button class="vjs-descriptions-button vjs-menu-button vjs-menu-button-popup vjs-button"
                                                type="button" aria-live="polite" aria-disabled="false" title="Descriptions" aria-haspopup="true"
                                                aria-expanded="false">
                                            <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                            <span class="vjs-control-text">Descriptions</span>
                                        </button>
                                        <div class="vjs-menu">
                                            <ul class="vjs-menu-content" role="menu">
                                                <li class="vjs-menu-item vjs-selected" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-disabled="false" aria-checked="true">
                                                    <span class="vjs-menu-item-text">descriptions off</span>
                                                    <span class="vjs-control-text">, selected</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="vjs-subs-caps-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden">
                                        <button class="vjs-subs-caps-button vjs-menu-button vjs-menu-button-popup vjs-button"
                                                type="button" aria-live="polite" aria-disabled="false" title="Captions" aria-haspopup="true"
                                                aria-expanded="false">
                                            <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                            <span class="vjs-control-text">Captions</span>
                                        </button>
                                        <div class="vjs-menu">
                                            <ul class="vjs-menu-content" role="menu">
                                                <li class="vjs-menu-item vjs-texttrack-settings" tabindex="-1" role="menuitem" aria-live="polite" aria-disabled="false">
                                                    <span class="vjs-menu-item-text">captions settings</span>
                                                    <span class="vjs-control-text">, opens captions settings dialog</span>
                                                </li>
                                                <li class="vjs-menu-item vjs-selected" tabindex="-1" role="menuitemcheckbox" aria-live="polite" aria-disabled="false" aria-checked="true">
                                                    <span class="vjs-menu-item-text">captions off</span>
                                                    <span class="vjs-control-text">, selected</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="vjs-audio-button vjs-menu-button vjs-menu-button-popup vjs-control vjs-button vjs-hidden">
                                        <button class="vjs-audio-button vjs-menu-button vjs-menu-button-popup vjs-button" type="button"
                                                aria-live="polite" aria-disabled="false" title="Audio Track" aria-haspopup="true"
                                                aria-expanded="false">
                                            <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                            <span class="vjs-control-text">Audio Track</span>
                                        </button>
                                        <div class="vjs-menu">
                                            <ul class="vjs-menu-content" role="menu"></ul>
                                        </div>
                                    </div>
                                    <button class="vjs-fullscreen-control vjs-control vjs-button" type="button" aria-live="polite"
                                            title="Fullscreen" aria-disabled="false">
                                        <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                        <span class="vjs-control-text">Fullscreen</span>
                                    </button>
                                </div>
                                <div class="vjs-error-display vjs-modal-dialog vjs-hidden " tabindex="-1" aria-describedby="step1_component_360_description"
                                     aria-hidden="true" aria-label="Modal Window" role="dialog">
                                    <p class="vjs-modal-dialog-description vjs-control-text" id="step1_component_360_description">This is a modal window.</p>
                                    <div class="vjs-modal-dialog-content" role="document"></div>
                                </div>
                                <div class="vjs-modal-dialog vjs-hidden  vjs-text-track-settings" tabindex="-1" aria-describedby="step1_component_366_description"
                                     aria-hidden="true" aria-label="Caption Settings Dialog" role="dialog">
                                    <p class="vjs-modal-dialog-description vjs-control-text" id="step1_component_366_description">Beginning of dialog window. Escape will cancel and close the window.</p>
                                    <div class="vjs-modal-dialog-content" role="document">
                                        <div class="vjs-track-settings-colors">
                                            <fieldset class="vjs-fg-color vjs-track-setting">
                                                <legend id="captions-text-legend-step1_component_366">Text</legend>
                                                <label id="captions-foreground-color-step1_component_366" class="vjs-label">Color</label>
                                                <select aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366">
                                                    <option id="captions-foreground-color-step1_component_366-White" value="#FFF"
                                                            aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-White">White
                                                    </option>
                                                    <option id="captions-foreground-color-step1_component_366-Black"
                                                            value="#000" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-Black">Black
                                                    </option>
                                                    <option id="captions-foreground-color-step1_component_366-Red"
                                                            value="#F00" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-Red">Red
                                                    </option>
                                                    <option id="captions-foreground-color-step1_component_366-Green"
                                                            value="#0F0" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-Green">Green
                                                    </option>
                                                    <option id="captions-foreground-color-step1_component_366-Blue"
                                                            value="#00F" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-Blue">Blue
                                                    </option>
                                                    <option id="captions-foreground-color-step1_component_366-Yellow"
                                                            value="#FF0" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-Yellow">Yellow
                                                    </option>
                                                    <option id="captions-foreground-color-step1_component_366-Magenta"
                                                            value="#F0F" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-Magenta">Magenta
                                                    </option>
                                                    <option id="captions-foreground-color-step1_component_366-Cyan"
                                                            value="#0FF" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-color-step1_component_366 captions-foreground-color-step1_component_366-Cyan">Cyan
                                                    </option>
                                                </select>
                                                <span class="vjs-text-opacity vjs-opacity">
                                                    <label id="captions-foreground-opacity-step1_component_366" class="vjs-label">Transparency</label>
                                                    <select aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-opacity-step1_component_366">
                                                        <option id="captions-foreground-opacity-step1_component_366-Opaque" value="1"
                                                                aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-opacity-step1_component_366 captions-foreground-opacity-step1_component_366-Opaque">Opaque</option>
                                                        <option id="captions-foreground-opacity-step1_component_366-Semi-Transparent"
                                                                value="0.5" aria-labelledby="captions-text-legend-step1_component_366 captions-foreground-opacity-step1_component_366 captions-foreground-opacity-step1_component_366-Semi-Transparent">Semi-Transparent</option>
                                                    </select>
                                                </span>
                                            </fieldset>
                                            <fieldset class="vjs-bg-color vjs-track-setting">
                                                <legend id="captions-background-step1_component_366">Background</legend>
                                                <label id="captions-background-color-step1_component_366"
                                                       class="vjs-label">Color</label>
                                                <select aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366">
                                                    <option id="captions-background-color-step1_component_366-Black" value="#000"
                                                            aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-Black">Black
                                                    </option>
                                                    <option id="captions-background-color-step1_component_366-White"
                                                            value="#FFF" aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-White">White
                                                    </option>
                                                    <option id="captions-background-color-step1_component_366-Red"
                                                            value="#F00" aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-Red">Red
                                                    </option>
                                                    <option id="captions-background-color-step1_component_366-Green"
                                                            value="#0F0" aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-Green">Green
                                                    </option>
                                                    <option id="captions-background-color-step1_component_366-Blue"
                                                            value="#00F" aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-Blue">Blue
                                                    </option>
                                                    <option id="captions-background-color-step1_component_366-Yellow"
                                                            value="#FF0" aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-Yellow">Yellow
                                                    </option>
                                                    <option id="captions-background-color-step1_component_366-Magenta"
                                                            value="#F0F" aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-Magenta">Magenta
                                                    </option>
                                                    <option id="captions-background-color-step1_component_366-Cyan"
                                                            value="#0FF" aria-labelledby="captions-background-step1_component_366 captions-background-color-step1_component_366 captions-background-color-step1_component_366-Cyan">Cyan
                                                    </option>
                                                </select>
                                                <span class="vjs-bg-opacity vjs-opacity">
                                                    <label id="captions-background-opacity-step1_component_366" class="vjs-label">Transparency</label>
                                                    <select aria-labelledby="captions-background-step1_component_366 captions-background-opacity-step1_component_366">
                                                        <option id="captions-background-opacity-step1_component_366-Opaque" value="1"
                                                                aria-labelledby="captions-background-step1_component_366 captions-background-opacity-step1_component_366 captions-background-opacity-step1_component_366-Opaque">Opaque</option>
                                                        <option id="captions-background-opacity-step1_component_366-Semi-Transparent"
                                                                value="0.5" aria-labelledby="captions-background-step1_component_366 captions-background-opacity-step1_component_366 captions-background-opacity-step1_component_366-Semi-Transparent">Semi-Transparent</option>
                                                        <option id="captions-background-opacity-step1_component_366-Transparent"
                                                                value="0" aria-labelledby="captions-background-step1_component_366 captions-background-opacity-step1_component_366 captions-background-opacity-step1_component_366-Transparent">Transparent</option>
                                                    </select>
                                                </span>
                                            </fieldset>
                                            <fieldset class="vjs-window-color vjs-track-setting">
                                                <legend id="captions-window-step1_component_366">Window</legend>
                                                <label id="captions-window-color-step1_component_366" class="vjs-label">Color</label>
                                                <select aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366">
                                                    <option id="captions-window-color-step1_component_366-Black" value="#000"
                                                            aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-Black">Black
                                                    </option>
                                                    <option id="captions-window-color-step1_component_366-White"
                                                            value="#FFF" aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-White">White
                                                    </option>
                                                    <option id="captions-window-color-step1_component_366-Red"
                                                            value="#F00" aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-Red">Red
                                                    </option>
                                                    <option id="captions-window-color-step1_component_366-Green"
                                                            value="#0F0" aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-Green">Green
                                                    </option>
                                                    <option id="captions-window-color-step1_component_366-Blue"
                                                            value="#00F" aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-Blue">Blue
                                                    </option>
                                                    <option id="captions-window-color-step1_component_366-Yellow"
                                                            value="#FF0" aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-Yellow">Yellow
                                                    </option>
                                                    <option id="captions-window-color-step1_component_366-Magenta"
                                                            value="#F0F" aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-Magenta">Magenta
                                                    </option>
                                                    <option id="captions-window-color-step1_component_366-Cyan"
                                                            value="#0FF" aria-labelledby="captions-window-step1_component_366 captions-window-color-step1_component_366 captions-window-color-step1_component_366-Cyan">Cyan
                                                    </option>
                                                </select>
                                                <span class="vjs-window-opacity vjs-opacity">
                                                    <label id="captions-window-opacity-step1_component_366" class="vjs-label">Transparency</label>
                                                    <select aria-labelledby="captions-window-step1_component_366 captions-window-opacity-step1_component_366">
                                                        <option id="captions-window-opacity-step1_component_366-Transparent"
                                                                value="0" aria-labelledby="captions-window-step1_component_366 captions-window-opacity-step1_component_366 captions-window-opacity-step1_component_366-Transparent">Transparent</option>
                                                        <option id="captions-window-opacity-step1_component_366-Semi-Transparent"
                                                                value="0.5" aria-labelledby="captions-window-step1_component_366 captions-window-opacity-step1_component_366 captions-window-opacity-step1_component_366-Semi-Transparent">Semi-Transparent</option>
                                                        <option id="captions-window-opacity-step1_component_366-Opaque"
                                                                value="1" aria-labelledby="captions-window-step1_component_366 captions-window-opacity-step1_component_366 captions-window-opacity-step1_component_366-Opaque">Opaque</option>
                                                    </select>
                                                </span>
                                            </fieldset>
                                        </div>
                                        <div class="vjs-track-settings-font">
                                            <fieldset class="vjs-font-percent vjs-track-setting">
                                                <legend id="captions-font-size-step1_component_366" class="">Font Size</legend>
                                                <select aria-labelledby=" captions-font-size-step1_component_366">
                                                    <option id="captions-font-size-step1_component_366-50%" value="0.50" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-50%">50%</option>
                                                    <option id="captions-font-size-step1_component_366-75%" value="0.75"
                                                            aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-75%">75%
                                                    </option>
                                                    <option id="captions-font-size-step1_component_366-100%"
                                                            value="1.00" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-100%">100%
                                                    </option>
                                                    <option id="captions-font-size-step1_component_366-125%"
                                                            value="1.25" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-125%">125%
                                                    </option>
                                                    <option id="captions-font-size-step1_component_366-150%"
                                                            value="1.50" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-150%">150%
                                                    </option>
                                                    <option id="captions-font-size-step1_component_366-175%"
                                                            value="1.75" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-175%">175%
                                                    </option>
                                                    <option id="captions-font-size-step1_component_366-200%"
                                                            value="2.00" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-200%">200%
                                                    </option>
                                                    <option id="captions-font-size-step1_component_366-300%"
                                                            value="3.00" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-300%">300%
                                                    </option>
                                                    <option id="captions-font-size-step1_component_366-400%"
                                                            value="4.00" aria-labelledby=" captions-font-size-step1_component_366 captions-font-size-step1_component_366-400%">400%
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="vjs-edge-style vjs-track-setting">
                                                <legend id="step1_component_366" class="">Text Edge Style</legend>
                                                <select aria-labelledby=" step1_component_366">
                                                    <option id="step1_component_366-None" value="none" aria-labelledby=" step1_component_366 step1_component_366-None">None</option>
                                                    <option id="step1_component_366-Raised" value="raised" aria-labelledby=" step1_component_366 step1_component_366-Raised">Raised</option>
                                                    <option id="step1_component_366-Depressed" value="depressed"
                                                            aria-labelledby=" step1_component_366 step1_component_366-Depressed">Depressed
                                                    </option>
                                                    <option id="step1_component_366-Uniform" value="uniform"
                                                            aria-labelledby=" step1_component_366 step1_component_366-Uniform">Uniform
                                                    </option>
                                                    <option id="step1_component_366-Dropshadow" value="dropshadow"
                                                            aria-labelledby=" step1_component_366 step1_component_366-Dropshadow">Dropshadow
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset class="vjs-font-family vjs-track-setting">
                                                <legend id="captions-font-family-step1_component_366" class="">Font Family</legend>
                                                <select aria-labelledby=" captions-font-family-step1_component_366">
                                                    <option id="captions-font-family-step1_component_366-Proportional Sans-Serif"
                                                            value="proportionalSansSerif" aria-labelledby=" captions-font-family-step1_component_366 captions-font-family-step1_component_366-Proportional Sans-Serif">Proportional Sans-Serif
                                                    </option>
                                                    <option id="captions-font-family-step1_component_366-Monospace Sans-Serif"
                                                            value="monospaceSansSerif" aria-labelledby=" captions-font-family-step1_component_366 captions-font-family-step1_component_366-Monospace Sans-Serif">Monospace Sans-Serif
                                                    </option>
                                                    <option id="captions-font-family-step1_component_366-Proportional Serif"
                                                            value="proportionalSerif" aria-labelledby=" captions-font-family-step1_component_366 captions-font-family-step1_component_366-Proportional Serif">Proportional Serif
                                                    </option>
                                                    <option id="captions-font-family-step1_component_366-Monospace Serif"
                                                            value="monospaceSerif" aria-labelledby=" captions-font-family-step1_component_366 captions-font-family-step1_component_366-Monospace Serif">Monospace Serif
                                                    </option>
                                                    <option id="captions-font-family-step1_component_366-Casual"
                                                            value="casual" aria-labelledby=" captions-font-family-step1_component_366 captions-font-family-step1_component_366-Casual">Casual
                                                    </option>
                                                    <option id="captions-font-family-step1_component_366-Script"
                                                            value="script" aria-labelledby=" captions-font-family-step1_component_366 captions-font-family-step1_component_366-Script">Script
                                                    </option>
                                                    <option id="captions-font-family-step1_component_366-Small Caps"
                                                            value="small-caps" aria-labelledby=" captions-font-family-step1_component_366 captions-font-family-step1_component_366-Small Caps">Small Caps
                                                    </option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="vjs-track-settings-controls">
                                            <button class="vjs-default-button" title="restore all settings to the default values">Reset
                                                <span class="vjs-control-text"> restore all settings to the default values</span>
                                            </button>
                                            <button class="vjs-done-button">Done</button>
                                        </div>
                                    </div>
                                    <button class="vjs-close-button vjs-control vjs-button" type="button" aria-live="polite"
                                            aria-disabled="false" title="Close Modal Dialog">
                                        <span aria-hidden="true" class="vjs-icon-placeholder"></span>
                                        <span class="vjs-control-text">Close Modal Dialog</span>
                                    </button>
                                    <p class="vjs-control-text">End of dialog window.</p>
                                </div>
                            </div>
                            <!--
                            <script>
                                var videoArr = [];
                                var videoIDs = [];

                                if (typeof documentReady !== 'function') {
                                    var documentReady = function(fn) {
                                        document.addEventListener("DOMContentLoaded", fn)
                                    }
                                }
                                documentReady(function() {

                                    jQuery('video').each(function() {
                                        videoEl = $(this);
                                        videoID = $(this).attr('id');
                                        videoIDs.push(videoID);
                                        videoArr[videoID] = videojs(videoID, {
                                            'nativeControlsForTouch': false
                                        }, function() {});
                                        // Dissalow right button click
                                        videoEl.bind('contextmenu', function(event) {
                                            return false;
                                        });
                                        thisPlayer = videoArr[videoID].player();

                                        if (videoEl.attr('autoplay')) {
                                            window.addEventListener('touchstart', function videoStart() {
                                                //console.log('first touch');
                                                for (var i = 0, longth = videoIDs.length; i < longth; i++) {
                                                    if ($('#' + videoIDs[i] + '').attr('autoplay')) {
                                                        thisPlayer = videoArr[videoIDs[i]].player();
                                                    }
                                                }
                                                thisPlayer.play();
                                                this.removeEventListener('touchstart', videoStart);
                                            });
                                            thisPlayer.play();
                                        }
                                    });

                                    $('video, .vjs-poster, .vjs-big-play-button').click(function() {
                                        var thisID = $(this).parent().attr('id');
                                        var thisID2 = thisID + '_html5_api';
                                        videoIDs.forEach(function(id) {
                                            if (thisID !== id && thisID2 !== id) {
                                                videoArr[id] && videoArr[id].pause();
                                            }
                                        });
                                    });

                                    $('video').each(function() {
                                        var videos = $(this);
                                        videos.on('touchend', function() {
                                            var targetVideo = this;
                                            if (targetVideo.paused) {
                                                targetVideo.play();
                                            } else {
                                                targetVideo.pause();
                                            }
                                        });
                                    });

                                    $('.vjs-poster').each(function() {
                                        var videos = $(this).closest('video');
                                        videos.on('touchend', function() {
                                            var targetVideo = this;
                                            if (targetVideo.paused) {
                                                targetVideo.play();
                                            } else {
                                                targetVideo.pause();
                                            }
                                        });
                                    });

                                });
                            </script>
-->
                        </div>
                    </div>
                </div>
                <div class="w-col w-col-4 header-form">
                    <div class="fixed form w-form form-home-1" data-ix="shop-form">
                        <div class="title-form">Register Now For A FREE Trial</div>
                        <div id="formWrapper1" class="formWrapper">
                            <link href="./tesler_files/default.css" rel="stylesheet" type="text/css">
                            <link href="./tesler_files/stylesheet.css" rel="stylesheet" type="text/css">
                            <link href="./tesler_files/stylesheet(1).css" rel="stylesheet" type="text/css">
                            <form id="register_form" class="form-container"></form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="testimonials-section">
        <div class="w-row">
            <div class="clm w-col w-col-3">
                <div class="main testimonial-box">
                    <div class="bigg txt w-preserve-3d">OUR MEMBERS</div>
                </div>
            </div>
            <div class="clm w-col w-col-3">
                <div class="img2 testimonial-box">
                    <div class="testimonial-txt">Profit:
                        <strong>$12,853</strong>
                    </div>
                    <div class="txt">“Thanks to TESLER; over $15,000 in my first 3 days! At first I thought TESLER was going to be complicated
                                     but it’s been really straight forward. I just signed up, opened my trading account and let TESLER
                                     do the hard work. So far the results have beat my wildest expectations.”
                    </div>
                </div>
            </div>
            <div class="clm w-col w-col-3">
                <div class="img3 testimonial-box">
                    <div class="testimonial-txt">Profit:
                        <strong>$7,950</strong>
                    </div>
                    <div class="txt">"Dear Steven and the Tesler Team, I’ve never seen such an ROI! $10,465 in just 48 hours with zero risk
                                     is a lot of money for me... Huge Thank You Steven!"
                    </div>
                </div>
            </div>
            <div class="clm w-col w-col-3">
                <div class="img4 testimonial-box">
                    <div class="testimonial-txt">Profit:
                        <strong>$9,058</strong>
                    </div>
                    <div class="txt">"Tesler actually delivers! For many of my viewers that does mean a lot!!! I never told you this but my
                                     main profession is to find CFD software that doesn’t work as a critical blogger… There are many of
                                     them… fortunately for you and your members I couldn’t find any reason not to recommend your high
                                     achieving Tesler software. Full marks!"
                    </div>
                </div>
            </div>
        </div>
        <div class="w-row">
            <div class="clm w-col w-col-3">
                <div class="img5 testimonial-box">
                    <div class="txt">"Tesler delivered $26,000 plus in my first 5 dys [sic]! Where I come from in Rome times are tough and
                                     a good job can be hard to find.
                        <br> Your Tesler software had improved my life and the life of my family all in a matter of days. Thank
                                     you for this chance…
                        <br> we really do appreciate it"
                    </div>
                    <div class="testimonial-txt">Profit:
                        <strong>$6,236</strong>
                    </div>
                </div>
            </div>
            <div class="clm w-col w-col-3">
                <div class="img6 testimonial-box">
                    <div class="testimonial-txt">Profit:
                        <strong>$16,420</strong>
                    </div>
                    <div class="txt">“I never expected to generate much profit as a Tesler beta tester. Boy, was I wrong! I’ve earned nearly
                                     30 thousand bucks in just 2 weeks. At this rate I’ll reach $82,478.22 within my first month. Incredibly
                                     pleased.”
                    </div>
                </div>
            </div>
            <div class="clm w-col w-col-3">
                <div class="img7 testimonial-box">
                    <div class="testimonial-txt">Profit:
                        <strong>$13,612</strong>
                    </div>
                    <div class="txt">"Tesler? Heck yeah! My kids thought I was pulling prank on them when I showed them how much I made! With
                                     in the first hour I made $208.33!!! That’s all I needed to continue"...
                    </div>
                </div>
            </div>
            <div class="clm w-col w-col-3">
                <div class="germany testimonial-box">
                    <div class="testimonial-txt">Profit:
                        <strong>$5,512</strong>
                    </div>
                    <div class="txt">“I was simply amazed by the profits I generated with TESLER. It’s so easy to use and the results have
                                     been nothing short of OUTSTANDING! I recommend it highly, especially if you don’t
                        <br> know much about the markets because its 'click-click' simple.” Thank you so much Steven and the
                                     Team!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-3">
        <div class="w-container">
            <div class="w-row">
                <div class="w-col w-col-6">
                    <img class="gif-img" src="./tesler_files/images/4.jpg">
                </div>
                <div class="w-clearfix w-col w-col-6">
                    <h1 class="h1">TESLER DELIVERS PROMISES</h1>
                    <div class="point-txt">Perfect for 100% Beginers or Pro's</div>
                    <div class="_222 point-txt">Game changing "Lead Pattern" Algorithm</div>
                    <div class="_333 point-txt">Generates $5000 per day per user Guaranteed</div>
                    <div class="_444 point-txt">Runs on any device, installs in just 2 minutes.</div>
                    <img onclick="scrlToTOP ()" class="btn-icon" data-ix="open-popup" sizes="115px" src="./tesler_files/images/mac_App_Store_Badge_EN.png"
                         style="transition: all 0.35s ease 0s;">
                    <img onclick="scrlToTOP ()" class="btn-icon google" data-ix="open-popup" src="./tesler_files/images/images.png" style="transition: all 0.35s ease 0s;">
                </div>
            </div>
        </div>
    </div>
    <div class="section-2">
        <div class="w-container">
            <div class="w-row">
                <div class="w-col w-col-5">
                    <h2 class="white-title">Clients Choose us because</h2>
                </div>
                <div class="w-col w-col-7">
                    <div class="white-txt">Our TESLER technology is constantly monitoring the world’s financial markets, 24/7
                                           Massive Data Crunching Mainframes to spot patterns in the worlds markets. This allows normal people
                                           just like you to receive an automated slice of the 7.8 trillion dollars that are traded every single
                                           day!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-5 w-hidden-small w-hidden-tiny">
        <div class="row-news w-row">
            <div class="row-news-clm w-col w-col-5">
                <div class="half-nwes w-row">
                    <div class="_200 background w-col w-col-6"></div>
                    <div class="_200 w-col w-col-6">
                        <div class="news-div">
                            <div class="date-time">06/06/2018 09:28 am</div>
                            <h1 class="news-title">Drugmakers Jump</h1>
                            <div>Pharmaceutical stocks and bonds were among the day’s biggest winners today, Tesler pounces...
                            </div>
                        </div>
                    </div>
                </div>
                <div class="_200-px">
                    <div class="news-div">
                        <div class="date-time white">06/06/2018 09:28 am</div>
                        <h1 class="news-title">Unexpected Election Outcome</h1>
                        <div>Here’s one way to sum up how Tesler made a killing for its members following the U.S. presidential
                             election: Investors didn’t do what they were expected to do after American voters didn’t do what
                             they were expected to do. Tesler Members made huge windfall profits!!!
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-news-clm w-col w-col-7">
                <div class="w-row">
                    <div class="_400 w-col w-col-6"></div>
                    <div class="_400-2 w-col w-col-6">
                        <div class="news-div">
                            <div class="date-time">06/06/2018 07:58 am</div>
                            <h1 class="news-title">How to Play the Nasdaq</h1>
                            <div>Tesler analyzes Nasdaq "Lead Patterns" after Kevin Kelly discusses the recent performance of
                                 stocks and his options strategy for the Nasdaq 100 Index. Tesler Members make big bank (Source:
                                 Bloomburg Press)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display: none;">
        <img id="img-to-footer" class="footer-logo" sizes="200px" src="./tesler_files/images/Tesler_1.png" alt="">
    </div>
@endsection