<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="mobile-footer text-center d-md-none <?php echo $this->is_webview == 'web' ? 'is_web' : 'is_mobile'; ?>">
    <div class="container">
        <div class="row">
            <div style="max-width: 20%; width: 20%">
                <a href="<?php echo lang_base_url(); ?>" class="f-btn <?php echo $this->selected_btn == "f-btn-home" ? "f-btn-selected" : ""; ?>" name="f-btn-home">
                    <div class="f-btn-icon">
                        <svg version="1.1" class="<?php echo $this->selected_btn == "f-btn-home" ? "f-btn-show" : "f-btn-hidden"; ?> fill" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
                            <g>
                                <path d="M341.333,204.425c-30.466,22.376-71.934,22.376-102.4,0c-30.466,22.376-71.934,22.376-102.4,0
			c-30.172,23.257-72.228,23.257-102.4,0c0,0.137,0,0.239,0,0.375v221.867c0,28.277,22.923,51.2,51.2,51.2h85.333V290.133
			c0-9.426,7.641-17.067,17.067-17.067h102.4c9.426,0,17.067,7.641,17.067,17.067v187.733h85.333c28.277,0,51.2-22.923,51.2-51.2
            V204.8c0-0.137,0-0.239,0-0.375C413.562,227.682,371.505,227.682,341.333,204.425z" />
                            </g>
                            <g>
                                <path d="M34.133,136.533c0,28.277,22.923,51.2,51.2,51.2c14.759-0.009,28.774-6.483,38.349-17.715
			c6.679-7.097,17.848-7.437,24.945-0.757c0.26,0.245,0.513,0.497,0.757,0.757c18.976,21.18,51.529,22.965,72.709,3.989
			c1.402-1.256,2.733-2.587,3.989-3.989c6.679-7.097,17.848-7.437,24.945-0.757c0.26,0.245,0.513,0.497,0.757,0.757
			c18.977,21.18,51.529,22.965,72.709,3.989c1.401-1.256,2.733-2.587,3.989-3.989c6.679-7.097,17.848-7.437,24.945-0.757
            c0.26,0.245,0.513,0.497,0.757,0.757c9.575,11.232,23.589,17.706,38.349,17.715c28.277,0,51.2-22.923,51.2-51.2H34.133z" />
                            </g>
                            <path d="M51.2,0c-7.349-0.002-13.874,4.701-16.196,11.674L4.762,102.4h114.705V0H51.2z" />
                            <rect x="153.6" y="0" width="68.267" height="102.4" />
                            <path d="M442.863,11.674C440.541,4.701,434.016-0.002,426.667,0H358.4v102.4h114.705L442.863,11.674z" />
                            <rect x="256" y="0" width="68.267" height="102.4" />
                        </svg>
                        <svg version="1.1" class="<?php echo $this->selected_btn == "f-btn-home" ? "f-btn-hidden" : "f-btn-show"; ?> outline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.867 477.867" style="enable-background:new 0 0 477.867 477.867;" xml:space="preserve">
                            <path d="M476.996,114.074l-34.133-102.4C440.541,4.701,434.016-0.002,426.667,0H51.2c-7.349-0.002-13.874,4.701-16.196,11.674
			L0.87,114.074c-0.526,1.594-0.82,3.255-0.87,4.932c0,0.171,0,0.29,0,0.461v17.067c0.062,26.74,12.707,51.892,34.133,67.891
			c0,0.137,0,0.239,0,0.375v221.867c0,28.277,22.923,51.2,51.2,51.2h307.2c28.277,0,51.2-22.923,51.2-51.2V204.8
			c0-0.137,0-0.239,0-0.375c21.426-15.999,34.072-41.151,34.133-67.891v-17.067c0-0.171,0-0.29,0-0.461
			C477.816,117.328,477.523,115.667,476.996,114.074z M358.4,34.133h55.962l22.767,68.267H358.4V34.133z M256,34.133h68.267V102.4
			H256V34.133z M153.6,34.133h68.267V102.4H153.6V34.133z M63.505,34.133h55.962V102.4H40.738L63.505,34.133z M273.067,443.733
			H204.8V307.2h68.267V443.733z M409.6,426.667c0,9.426-7.641,17.067-17.067,17.067H307.2v-153.6
			c0-9.426-7.641-17.067-17.067-17.067h-102.4c-9.426,0-17.067,7.641-17.067,17.067v153.6H85.333
			c-9.426,0-17.067-7.641-17.067-17.067V220.16c23.951,4.917,48.857-0.799,68.267-15.667c30.466,22.376,71.934,22.376,102.4,0
			c30.466,22.376,71.934,22.376,102.4,0c19.41,14.869,44.316,20.584,68.267,15.667V426.667z M392.533,187.733
			c-14.759-0.009-28.774-6.483-38.349-17.715c-6.202-7.097-16.984-7.823-24.081-1.621c-0.576,0.503-1.118,1.045-1.621,1.621
			c-18.977,21.18-51.529,22.965-72.709,3.989c-1.401-1.256-2.733-2.587-3.989-3.989c-6.679-7.097-17.847-7.437-24.945-0.757
			c-0.26,0.245-0.513,0.497-0.757,0.757c-18.976,21.18-51.529,22.965-72.709,3.989c-1.402-1.256-2.733-2.587-3.989-3.989
			c-6.679-7.097-17.848-7.437-24.945-0.757c-0.26,0.245-0.513,0.497-0.757,0.757c-9.575,11.232-23.589,17.706-38.349,17.715
			c-28.277,0-51.2-22.923-51.2-51.2h409.6C443.733,164.81,420.81,187.733,392.533,187.733z" />
                        </svg>
                    </div>
                    <span class="f-btn-text"><?php echo trans("main"); ?></span>
                </a>
            </div>
            <!-- message -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>messages" class="f-btn <?php echo $this->selected_btn == "f-btn-message" ? "f-btn-selected" : ""; ?>" name="f-btn-message">
                        <div class="f-btn-icon">
                            <svg aria-hidden="true" class="<?php echo $this->selected_btn == "f-btn-message" ? "f-btn-show" : "f-btn-hidden"; ?> fill" focusable="false" data-prefix="fas" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"></path>
                            </svg>
                            <svg aria-hidden="true" class="<?php echo $this->selected_btn == "f-btn-message" ? "f-btn-hidden" : "f-btn-show"; ?> outline" focusable="false" data-prefix="far" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M144 208c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"></path>
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("chat"); ?></span>
                        <?php if ($unread_message_count > 0) : ?>
                            <span class="span-message-count" style="position:absolute;left:8px;top:-5px"><?php echo $unread_message_count; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-message" ? "f-btn-selected" : ""; ?>" name="f-btn-message">
                        <div class="f-btn-icon">
                            <svg aria-hidden="true" class="<?php echo $this->selected_btn == "f-btn-message" ? "f-btn-show" : "f-btn-hidden"; ?> fill" focusable="false" data-prefix="fas" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"></path>
                            </svg>
                            <svg aria-hidden="true" class="<?php echo $this->selected_btn == "f-btn-message" ? "f-btn-hidden" : "f-btn-show"; ?> outline" focusable="false" data-prefix="far" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M144 208c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm112 0c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 368c-26.7 0-53.1-4.1-78.4-12.1l-22.7-7.2-19.5 13.8c-14.3 10.1-33.9 21.4-57.5 29 7.3-12.1 14.4-25.7 19.9-40.2l10.6-28.1-20.6-21.8C69.7 314.1 48 282.2 48 240c0-88.2 93.3-160 208-160s208 71.8 208 160-93.3 160-208 160z"></path>
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("chat"); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <!-- sellnow -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>sell-now" class="f-btn <?php echo $this->selected_btn == "f-btn-add" ? "f-btn-selected" : ""; ?>" name="f-btn-add">
                        <div class="f-btn-icon">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 185 185" style="enable-background:new 0 0 185 185;" xml:space="preserve">
                                <path d="M15,60.46H0V0h60.46v15H15V60.46z M170,170h-45.46v15H185v-60.46h-15V170z M124.54,15H170v45.46h15V0h-60.46V15z M15,124.54
	                                H0V185h60.46v-15H15V124.54z M138.906,85H100V46.093H85V85H46.094v15H85v38.907h15V100h38.906V85z" />
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("post"); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-add" ? "f-btn-selected" : ""; ?>" name="f-btn-add">
                        <div class="f-btn-icon">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 185 185" style="enable-background:new 0 0 185 185;" xml:space="preserve">
                                <path d="M15,60.46H0V0h60.46v15H15V60.46z M170,170h-45.46v15H185v-60.46h-15V170z M124.54,15H170v45.46h15V0h-60.46V15z M15,124.54
	                                H0V185h60.46v-15H15V124.54z M138.906,85H100V46.093H85V85H46.094v15H85v38.907h15V100h38.906V85z" />
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("post"); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <!-- notifications -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>notifications" class="f-btn <?php echo $this->selected_btn == "f-btn-notification" ? "f-btn-selected" : ""; ?>" name="f-btn-notification">
                        <div class="f-btn-icon">
                            <svg version="1.1" class="<?php echo $this->selected_btn == "f-btn-notification" ? "f-btn-show" : "f-btn-hidden"; ?> fill" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 479.536 479.536" style="enable-background:new 0 0 479.536 479.536;" xml:space="preserve">
                                <path d="M475.804,336.286c-0.5-2.7-1.1-5.5-2-8.2c-8.6-24-33.2-38.4-58.3-34.1c-8.3,1.3-16.1-4.4-17.4-12.7l-12.6-80.8
                c-10.5-68.5-60-124.6-126.6-143.4c-6.1-37.1-41-62.2-78.1-56.2c-36.6,6-61.7,40.2-56.4,76.9c-57.4,36.3-87.8,103.3-77.1,170.5
                l13.6,86.1c1.2,8.3-4.4,16.1-12.7,17.4c-25.2,3.6-44.2,24.8-45.1,50.3c-0.3,28.3,22.4,51.4,50.7,51.7c0.2,0,0.4,0,0.5,0
                c2.7,0,5.3-0.2,8-0.6l52.5-8.3c18.3,32.6,59.5,44.3,92.2,26c17.2-9.7,29.4-26.3,33.3-45.7l192.9-30.4
                C461.104,390.386,480.204,364.186,475.804,336.286z M173.704,445.486c-7.2,0-14.3-2.3-20.1-6.6l47.8-7.5
                C195.004,440.286,184.704,445.486,173.704,445.486z M219.704,51.386c-6.4-0.2-12.7,0-19.1,0.5c-6.7,0.6-13.3,1.7-19.9,3.1
                c-1.4,0.3-2.8,0.7-4.2,1c-5.4,1.3-10.6,2.7-15.8,4.5c-0.5,0.1-1.1,0.2-1.6,0.4c3.6-12.9,14.4-22.5,27.6-24.5
                c1.8-0.3,3.6-0.4,5.4-0.4c11.4,0.1,22.1,5.8,28.4,15.4H219.704z" /></svg>
                            <svg version="1.1" class="<?php echo $this->selected_btn == "f-btn-notification" ? "f-btn-hidden" : "f-btn-show"; ?> outline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 479.619 479.619" style="enable-background:new 0 0 479.619 479.619;" xml:space="preserve">
                                <path d="M475.855,336.376c-0.441-2.809-1.116-5.577-2.017-8.275c-8.621-23.991-33.203-38.346-58.334-34.065
			c-8.313,1.309-16.114-4.368-17.425-12.681l-12.646-80.913c-10.379-68.459-59.835-124.522-126.464-143.36
			c-6.06-37.088-41.038-62.242-78.127-56.182c-36.598,5.98-61.669,40.163-56.376,76.867
			c-57.432,36.346-87.748,103.365-77.124,170.496l13.551,86.118c1.241,8.297-4.405,16.054-12.68,17.425
			c-25.234,3.641-44.226,24.849-45.073,50.33c-0.292,28.275,22.393,51.434,50.668,51.726c0.177,0.002,0.355,0.003,0.532,0.003
			c2.669-0.002,5.333-0.207,7.97-0.614l52.531-8.26c18.274,32.622,59.533,44.254,92.155,25.98
			c17.231-9.652,29.388-26.347,33.285-45.709L433.22,394.9C461.154,390.513,480.243,364.311,475.855,336.376z M186.777,36.313
			c1.779-0.277,3.576-0.42,5.376-0.427c11.441,0.061,22.098,5.822,28.416,15.36h-0.819c-6.365-0.192-12.737-0.009-19.081,0.546
			c-6.681,0.638-13.32,1.664-19.883,3.072c-1.417,0.29-2.816,0.7-4.216,1.041c-5.376,1.263-10.65,2.748-15.821,4.506
			c-0.512,0.154-1.041,0.239-1.553,0.427C162.797,47.969,173.576,38.384,186.777,36.313z M173.806,445.486
			c-7.233,0.008-14.277-2.314-20.087-6.622l47.787-7.492C195.075,440.252,184.77,445.503,173.806,445.486z M439.824,353.207
			c-2.613,4.291-6.983,7.213-11.947,7.987L222.31,393.518l-99.891,15.718l-65.365,10.24c-4.952,0.808-10.006-0.63-13.79-3.925
			c-3.862-3.293-6.057-8.135-5.99-13.21c0.739-8.753,7.526-15.782,16.247-16.828c26.88-4.309,45.234-29.518,41.079-56.422
			l-13.534-86.118c-8.864-56.814,18.723-113.111,69.052-140.919c0.296-0.099,0.586-0.213,0.87-0.341
			c16.334-8.85,34.302-14.275,52.804-15.94c5.607-0.493,11.24-0.601,16.862-0.324l2.799,0.137
			c5.816,0.352,11.602,1.081,17.323,2.185c0.188,0,0.358,0,0.546,0c57.748,12.493,101.701,59.479,110.319,117.931l12.732,80.913
			c4.232,26.931,29.49,45.336,56.422,41.114c8.608-1.681,17.214,2.907,20.617,10.991
			C443.075,343.541,442.493,348.857,439.824,353.207z" /></svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("notification"); ?></span>
                        <?php $notification_count = get_notification_count();
                        if ($notification_count > 0) : ?>
                            <span class="notification"><?php echo $notification_count; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-notification" ? "f-btn-selected" : ""; ?>" name="f-btn-notification">
                        <div class="f-btn-icon">
                            <svg version="1.1" class="<?php echo $this->selected_btn == "f-btn-notification" ? "" : "f-btn-hidden"; ?> fill" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 479.536 479.536" style="enable-background:new 0 0 479.536 479.536;" xml:space="preserve">
                                <path d="M475.804,336.286c-0.5-2.7-1.1-5.5-2-8.2c-8.6-24-33.2-38.4-58.3-34.1c-8.3,1.3-16.1-4.4-17.4-12.7l-12.6-80.8
                c-10.5-68.5-60-124.6-126.6-143.4c-6.1-37.1-41-62.2-78.1-56.2c-36.6,6-61.7,40.2-56.4,76.9c-57.4,36.3-87.8,103.3-77.1,170.5
                l13.6,86.1c1.2,8.3-4.4,16.1-12.7,17.4c-25.2,3.6-44.2,24.8-45.1,50.3c-0.3,28.3,22.4,51.4,50.7,51.7c0.2,0,0.4,0,0.5,0
                c2.7,0,5.3-0.2,8-0.6l52.5-8.3c18.3,32.6,59.5,44.3,92.2,26c17.2-9.7,29.4-26.3,33.3-45.7l192.9-30.4
                C461.104,390.386,480.204,364.186,475.804,336.286z M173.704,445.486c-7.2,0-14.3-2.3-20.1-6.6l47.8-7.5
                C195.004,440.286,184.704,445.486,173.704,445.486z M219.704,51.386c-6.4-0.2-12.7,0-19.1,0.5c-6.7,0.6-13.3,1.7-19.9,3.1
                c-1.4,0.3-2.8,0.7-4.2,1c-5.4,1.3-10.6,2.7-15.8,4.5c-0.5,0.1-1.1,0.2-1.6,0.4c3.6-12.9,14.4-22.5,27.6-24.5
                c1.8-0.3,3.6-0.4,5.4-0.4c11.4,0.1,22.1,5.8,28.4,15.4H219.704z" /></svg>
                            <svg version="1.1" class="<?php echo $this->selected_btn == "f-btn-notification" ? "f-btn-hidden" : ""; ?> outline" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 479.619 479.619" style="enable-background:new 0 0 479.619 479.619;" xml:space="preserve">
                                <path d="M475.855,336.376c-0.441-2.809-1.116-5.577-2.017-8.275c-8.621-23.991-33.203-38.346-58.334-34.065
			c-8.313,1.309-16.114-4.368-17.425-12.681l-12.646-80.913c-10.379-68.459-59.835-124.522-126.464-143.36
			c-6.06-37.088-41.038-62.242-78.127-56.182c-36.598,5.98-61.669,40.163-56.376,76.867
			c-57.432,36.346-87.748,103.365-77.124,170.496l13.551,86.118c1.241,8.297-4.405,16.054-12.68,17.425
			c-25.234,3.641-44.226,24.849-45.073,50.33c-0.292,28.275,22.393,51.434,50.668,51.726c0.177,0.002,0.355,0.003,0.532,0.003
			c2.669-0.002,5.333-0.207,7.97-0.614l52.531-8.26c18.274,32.622,59.533,44.254,92.155,25.98
			c17.231-9.652,29.388-26.347,33.285-45.709L433.22,394.9C461.154,390.513,480.243,364.311,475.855,336.376z M186.777,36.313
			c1.779-0.277,3.576-0.42,5.376-0.427c11.441,0.061,22.098,5.822,28.416,15.36h-0.819c-6.365-0.192-12.737-0.009-19.081,0.546
			c-6.681,0.638-13.32,1.664-19.883,3.072c-1.417,0.29-2.816,0.7-4.216,1.041c-5.376,1.263-10.65,2.748-15.821,4.506
			c-0.512,0.154-1.041,0.239-1.553,0.427C162.797,47.969,173.576,38.384,186.777,36.313z M173.806,445.486
			c-7.233,0.008-14.277-2.314-20.087-6.622l47.787-7.492C195.075,440.252,184.77,445.503,173.806,445.486z M439.824,353.207
			c-2.613,4.291-6.983,7.213-11.947,7.987L222.31,393.518l-99.891,15.718l-65.365,10.24c-4.952,0.808-10.006-0.63-13.79-3.925
			c-3.862-3.293-6.057-8.135-5.99-13.21c0.739-8.753,7.526-15.782,16.247-16.828c26.88-4.309,45.234-29.518,41.079-56.422
			l-13.534-86.118c-8.864-56.814,18.723-113.111,69.052-140.919c0.296-0.099,0.586-0.213,0.87-0.341
			c16.334-8.85,34.302-14.275,52.804-15.94c5.607-0.493,11.24-0.601,16.862-0.324l2.799,0.137
			c5.816,0.352,11.602,1.081,17.323,2.185c0.188,0,0.358,0,0.546,0c57.748,12.493,101.701,59.479,110.319,117.931l12.732,80.913
			c4.232,26.931,29.49,45.336,56.422,41.114c8.608-1.681,17.214,2.907,20.617,10.991
			C443.075,343.541,442.493,348.857,439.824,353.207z" /></svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("notification"); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <!-- account -->
            <?php if (auth_check()) : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="<?php echo lang_base_url(); ?>account/<?php echo $this->auth_user->slug; ?>" class="f-btn <?php echo $this->selected_btn == "f-btn-account" ? "f-btn-selected" : ""; ?>" name="f-btn-account">
                        <div style="height: 22px;">
                            <?php $profile = get_user($this->auth_user->id); ?>
                            <img src="<?php echo get_user_avatar($profile); ?>" alt="User" style="width: 25px;border-radius: 50%;height: 23px;margin-top: -3px;">
                        </div>
                        <span class="f-btn-text"><?php echo trans("profile"); ?></span>
                    </a>
                </div>
            <?php else : ?>
                <div style="max-width: 20%; width: 20%">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" class="f-btn <?php echo $this->selected_btn == "f-btn-account" ? "f-btn-selected" : ""; ?>" name="f-btn-account">
                        <div class="f-btn-icon">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256c2.581,0,5.099-0.32,7.68-0.384l0.896,0.171
                                    c0.704,0.128,1.387,0.213,2.091,0.213c0.981,0,1.984-0.128,2.923-0.405l1.195-0.341C405.056,503.509,512,392.171,512,256
                                    C512,114.837,397.163,0,256,0z M408.149,434.325c-1.003-3.264-3.264-6.016-6.549-7.104l-56.149-18.688
                                    c-19.605-8.171-28.736-39.552-30.869-52.139c14.528-13.504,27.947-33.621,27.947-51.797c0-6.187,1.749-8.555,1.408-8.619
                                    c3.328-0.832,6.037-3.2,7.317-6.379c1.045-2.624,10.24-26.069,10.24-41.877c0-0.875-0.107-1.749-0.32-2.581
                                    c-1.344-5.355-4.48-10.752-9.173-14.123v-49.664c0-30.699-9.344-43.563-19.243-51.008c-2.219-15.275-18.581-44.992-76.757-44.992
                                    c-59.477,0-96,55.915-96,96v49.664c-4.693,3.371-7.829,8.768-9.173,14.123c-0.213,0.853-0.32,1.728-0.32,2.581
                                    c0,15.808,9.195,39.253,10.24,41.877c1.28,3.179,2.965,5.205,6.293,6.037c0.683,0.405,2.432,2.795,2.432,8.96
                                    c0,18.176,13.419,38.293,27.947,51.797c-2.112,12.565-11.157,43.925-30.144,51.861l-56.896,18.965
                                    c-3.264,1.088-5.611,3.776-6.635,7.04C53.376,391.189,21.291,327.317,21.291,256c0-129.387,105.28-234.667,234.667-234.667
                                    S490.624,126.613,490.624,256C490.667,327.339,458.56,391.253,408.149,434.325z" />
                            </svg>
                        </div>
                        <span class="f-btn-text"><?php echo trans("login"); ?></span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (!isset($_COOKIE["modesy_cookies_warning"]) && $settings->cookies_warning) : ?>
    <div class="cookies-warning">
        <div class="text"><?php echo $this->settings->cookies_warning_text; ?></div>
        <a href="javascript:void(0)" onclick="hide_cookies_warning();" class="icon-cl"> <i class="icon-close"></i></a>
    </div>
<?php endif; ?>

<!-- Bootstrap JS-->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Owl-carousel -->
<script src="<?php echo base_url(); ?>assets/vendor/owl-carousel/owl.carousel.min.js"></script>
<!-- Plugins JS-->
<script src="<?php echo base_url(); ?>assets/js/plugins-1.4.js"></script>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var lang_base_url = '<?php echo lang_base_url(); ?>';
    var thousands_separator = '<?php echo $this->thousands_separator; ?>';
    var lang_folder = '<?php echo $this->selected_lang->folder_name; ?>';
    var fb_app_id = '<?php echo $this->general_settings->facebook_app_id; ?>';
    var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csfr_cookie_name = '<?php echo $this->config->item('csrf_cookie_name'); ?>';
    var is_hkm_one_country = '<?php echo @$is_hkm_one_country; ?>';
    var is_recaptcha_enabled = false;
    var txt_processing = '<?php echo trans("processing"); ?>';
    var sweetalert_ok = '<?php echo trans("ok"); ?>';
    var sweetalert_cancel = '<?php echo trans("cancel"); ?>';
    <?php if ($recaptcha_status == true) : ?>is_recaptcha_enabled = true;
    <?php endif; ?>
    $('#form-product-filters input[name=form_lang_base_url]').remove();
    $('#form-product-filters input[name=lang_folder]').remove();
    $('#formsearchzolmarket input[name=form_lang_base_url]').remove();
    $('#formsearchzolmarket input[name=lang_folder]').remove();
</script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<style>
    i,
    span[class*='icon'] {
        visibility: visible;
    }
</style>
</body>

</html>