<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_controller extends Home_Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->pagination_per_page = 15;
        $this->selected_btn = "f-btn-account";
    }

    /**
     * Profile
     */
    public function profile($slug)
    {
        if (!auth_check())
            redirect(lang_base_url() . 'account/' . $slug);
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);

        if (empty($data["user"])) {
            redirect(lang_base_url());
        }

        if (auth_check() && $data["user"]->id != $this->auth_user->id)
            redirect(lang_base_url() . 'account/' . $slug);

        $data['title'] = get_shop_name($data["user"]);
        $data['description'] = $data["user"]->username . " - " . $this->app_name;
        $data['keywords'] = $data["user"]->username . "," . $this->app_name;
        $data["active_tab"] = "products";
        $data["user_session"] = get_user_session();
        // if ($data["user"]->role == 'member') {
        //     redirect(lang_base_url() . 'favorites/' . $data["user"]->slug);
        // }


        //set pagination
        $pagination = $this->paginate(generate_profile_url($data["user"]), $this->product_model->get_user_products_count($data["user"]->slug), $this->pagination_per_page);
        $data['products'] = $this->product_model->get_paginated_user_products($data["user"]->slug, $pagination['per_page'], $pagination['offset']);
        // $data['mproducts'] = $this->product_model->get_paginated_user_products($data["user"]->slug, '1000000000000000000', '0');
        // $data['mpending_products'] = $this->product_model->get_paginated_user_pending_products($data["user"]->id, '1000000000000000000', '0');
        // $data['mhidden_products'] = $this->product_model->get_paginated_user_hidden_products($data["user"]->id, '1000000000000000000', '0');
        // $data['mdraft_products'] = $this->product_model->get_hkm_user_drafts($data["user"]->id, '1000000000000000000', '0');
        // $data["mfavorites_products"] = $this->product_model->get_user_favorited_products($data["user"]->id);
        // $data['mitems'] = $this->product_model->get_paginated_user_downloads($data["user"]->id, '1000000000000000000', '0');
        // $data["muser_session"] = get_user_session();
        // $data["mfollowers"] = $this->profile_model->get_followers($data["user"]->id);
        // $data["mfollowing_users"] = $this->profile_model->get_following_users($data["user"]->id);
        // $data["mreviews"] = $this->user_review_model->get_reviews($data["user"]->id);
        // $data['mreview_count'] = $this->user_review_model->get_review_count($data["user"]->id);
        // $data['mreviews'] = $this->user_review_model->get_limited_reviews($data["user"]->id, 5);
        // $data['mreview_limit'] = 5;

        // $data['orders'] = $this->order_model->get_paginated_orders(user()->id, 10000000000000, 0);
        // $data['compelte_orders'] = $this->order_model->get_paginated_completed_orders(user()->id, 10000000000000, 0);
        // $data['sales'] = $this->order_model->get_paginated_sales(user()->id, 10000000000000, 0);
        // $data['compelte_sales'] = $this->order_model->get_paginated_completed_sales(user()->id, 10000000000000,0);
        // $data['earnings'] = $this->earnings_model->get_paginated_earnings(user()->id, 10000000000000,0);
        // $data['payouts'] = $this->earnings_model->get_paginated_payouts(user()->id, 10000000000000,0);

        // $data['site_settings'] = get_site_settings();
        // $data['user_payout'] = $this->earnings_model->get_user_payout_account(user()->id);
        // if (empty($this->session->flashdata('msg_payout'))) {
        //     if ($this->payment_settings->payout_paypal_enabled) {
        //         $this->session->set_flashdata('msg_payout', "paypal");
        //     } elseif ($this->payment_settings->payout_iban_enabled) {
        //         $this->session->set_flashdata('msg_payout', "iban");
        //     } elseif ($this->payment_settings->payout_swift_enabled) {
        //         $this->session->set_flashdata('msg_payout', "swift");
        //     }
        // }


        // $this->load->model('bidding_model');
        // if(is_bidding_system_active()){
        //     if (is_user_vendor()) {
        // 		$data['active_tab'] = "received_quote_requests";
        // 		$data['received_request_count'] = $this->bidding_model->get_received_quote_requests_count(user()->id);
        // 		$data['sent_request_count'] = $this->bidding_model->get_sent_quote_requests_count(user()->id);
        // 		//set pagination
        // 		$data['quote_requests'] = $this->bidding_model->get_received_quote_requests_paginated(user()->id, 10000000000000, 0);

        // 	} else {
        // 		$data['active_tab'] = "sent_request_count";
        // 		$data['received_request_count'] = $this->bidding_model->get_received_quote_requests_count( user()->id);
        // 		$data['sent_request_count'] = $this->bidding_model->get_sent_quote_requests_count(user()->id);
        // 		//set pagination
        // 		$data['quote_requests'] = $this->bidding_model->get_sent_quote_requests_paginated(user()->id,10000000000000, 0);
        // 	}
        // }
        $data['user_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['days_left'] = $this->membership_model->get_user_plan_remaining_days_count($data['user_plan']);

        $footer['is_exist'] = true;
        
        $this->load->view('partials/_header', $data);
        $this->load->view('profile/profile', $data);
        $this->load->view('partials/_footer', $footer);
    }

    /**
     * Profile
     */
    public function product($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("products");
        $data['description'] = $data["user"]->username . " - " . $this->app_name;
        $data['keywords'] = $data["user"]->username . "," . $this->app_name;
        $data["active_tab"] = "products";
        $data["user_session"] = get_user_session();


        //set pagination
        $pagination = $this->paginate(generate_profile_url($data["user"]), $this->product_model->get_user_products_count($data["user"]->slug), $this->pagination_per_page);
        $data['products'] = $this->product_model->get_paginated_user_products($data["user"]->slug, $pagination['per_page'], $pagination['offset']);

        $this->load->view('partials/_header', $data);
        $this->load->view('profile/product', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Profile
     */
    public function account($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }

        $data['title'] = get_shop_name($data["user"]);
        $data['description'] = $data["user"]->username . " - " . $this->app_name;
        $data['keywords'] = $data["user"]->username . "," . $this->app_name;
        $data["active_tab"] = "products";
        $data["user_session"] = get_user_session();
        // if ($data["user"]->role == 'member') {
        //     redirect(lang_base_url() . 'favorites/' . $data["user"]->slug);
        // }


        //set pagination
        $pagination = $this->paginate(generate_profile_url($data["user"]), $this->product_model->get_user_products_count($data["user"]->slug), $this->pagination_per_page);
        $data['products'] = $this->product_model->get_paginated_user_products($data["user"]->slug, $pagination['per_page'], $pagination['offset']);

        $this->load->view('partials/_header', $data);
        $this->load->view('account/products', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Pending Products
     */
    public function pending_products()
    {
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_multi_vendor_active()) {
            redirect(lang_base_url());
        }
        $data["user"] = user();

        if ((auth_check() && $data["user"]->id != $this->auth_user->id)) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("pending_products");
        $data['description'] = trans("pending_products") . " - " . $this->app_name;
        $data['keywords'] = trans("pending_products") . "," . $this->app_name;
        $data["active_tab"] = "pending_products";
        //set pagination
        $pagination = $this->paginate(lang_base_url() . "pending-products", $this->product_model->get_user_pending_products_count($data["user"]->id), $this->pagination_per_page);
        $data['products'] = $this->product_model->get_paginated_user_pending_products($data["user"]->id, $pagination['per_page'], $pagination['offset']);
        $data["user_session"] = get_user_session();

        $data['mproducts'] = $this->product_model->get_paginated_user_products($data["user"]->slug, '1000000000000000000', '0');
        $data['mpending_products'] = $this->product_model->get_paginated_user_pending_products($data["user"]->id, '1000000000000000000', '0');
        $data['mhidden_products'] = $this->product_model->get_paginated_user_hidden_products($data["user"]->id, '1000000000000000000', '0');
        $data['mdraft_products'] = $this->product_model->get_hkm_user_drafts($data["user"]->id, '1000000000000000000', '0');
        $data["mfavorites_products"] = $this->product_model->get_user_favorited_products($data["user"]->id);
        $data['mitems'] = $this->product_model->get_paginated_user_downloads($data["user"]->id, '1000000000000000000', '0');
        $data["muser_session"] = get_user_session();
        $data["mfollowers"] = $this->profile_model->get_followers($data["user"]->id);
        $data["mfollowing_users"] = $this->profile_model->get_following_users($data["user"]->id);
        $data["mreviews"] = $this->user_review_model->get_reviews($data["user"]->id);
        $data['mreview_count'] = $this->user_review_model->get_review_count($data["user"]->id);
        $data['mreviews'] = $this->user_review_model->get_limited_reviews($data["user"]->id, 5);
        $data['mreview_limit'] = 5;
        $this->load->view('partials/_header', $data);
        $this->load->view('profile/pending_products', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Drafts
     */
    public function drafts()
    {
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_multi_vendor_active()) {
            redirect(lang_base_url());
        }
        $data["user"] = user();

        if ((auth_check() && $data["user"]->id != $this->auth_user->id)) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("drafts");
        $data['description'] = trans("drafts") . " - " . $this->app_name;
        $data['keywords'] = trans("drafts") . "," . $this->app_name;
        $data["active_tab"] = "drafts";
        //set pagination
        $pagination = $this->paginate(lang_base_url() . "drafts", $this->product_model->get_user_drafts_count($data["user"]->id), $this->pagination_per_page);
        $data['products'] = $this->product_model->get_paginated_user_drafts($data["user"]->id, $pagination['per_page'], $pagination['offset']);
        $data["user_session"] = get_user_session();

        $this->load->view('partials/_header', $data);
        $this->load->view('profile/drafts', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Downloads
     */
    public function downloads()
    {
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_sale_active()) {
            redirect(lang_base_url());
        }
        if ($this->general_settings->digital_products_system == 0) {
            redirect(lang_base_url());
        }
        $data["user"] = user();

        if ((auth_check() && $data["user"]->id != $this->auth_user->id)) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("downloads");
        $data['description'] = trans("downloads") . " - " . $this->app_name;
        $data['keywords'] = trans("downloads") . "," . $this->app_name;
        $data["active_tab"] = "downloads";
        //set pagination
        $pagination = $this->paginate(lang_base_url() . "downloads", $this->product_model->get_user_downloads_count($data["user"]->id), $this->pagination_per_page);
        $data['items'] = $this->product_model->get_paginated_user_downloads($data["user"]->id, $pagination['per_page'], $pagination['offset']);
        $data["user_session"] = get_user_session();

        $data['mproducts'] = $this->product_model->get_paginated_user_products($data["user"]->slug, '1000000000000000000', '0');
        $data['mpending_products'] = $this->product_model->get_paginated_user_pending_products($data["user"]->id, '1000000000000000000', '0');
        $data['mhidden_products'] = $this->product_model->get_paginated_user_hidden_products($data["user"]->id, '1000000000000000000', '0');
        $data['mdraft_products'] = $this->product_model->get_hkm_user_drafts($data["user"]->id, '1000000000000000000', '0');
        $data["mfavorites_products"] = $this->product_model->get_user_favorited_products($data["user"]->id);
        $data['mitems'] = $this->product_model->get_paginated_user_downloads($data["user"]->id, '1000000000000000000', '0');
        $data["muser_session"] = get_user_session();
        $data["mfollowers"] = $this->profile_model->get_followers($data["user"]->id);
        $data["mfollowing_users"] = $this->profile_model->get_following_users($data["user"]->id);
        $data["mreviews"] = $this->user_review_model->get_reviews($data["user"]->id);
        $data['mreview_count'] = $this->user_review_model->get_review_count($data["user"]->id);
        $data['mreviews'] = $this->user_review_model->get_limited_reviews($data["user"]->id, 5);
        $data['mreview_limit'] = 5;
        $this->load->view('partials/_header', $data);
        $this->load->view('profile/downloads', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Hidden Products
     */
    public function hidden_products()
    {
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_multi_vendor_active()) {
            redirect(lang_base_url());
        }
        $data["user"] = user();
        if ((auth_check() && $data["user"]->id != $this->auth_user->id)) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("hidden_products");
        $data['description'] = trans("hidden_products") . " - " . $this->app_name;
        $data['keywords'] = trans("hidden_products") . "," . $this->app_name;

        $data["active_tab"] = "hidden_products";
        //set pagination
        $pagination = $this->paginate(lang_base_url() . "hidden-products", $this->product_model->get_user_hidden_products_count($data["user"]->id), $this->pagination_per_page);
        $data['products'] = $this->product_model->get_paginated_user_hidden_products($data["user"]->id, $pagination['per_page'], $pagination['offset']);
        $data["user_session"] = get_user_session();

        $data['mproducts'] = $this->product_model->get_paginated_user_products($data["user"]->slug, '1000000000000000000', '0');
        $data['mpending_products'] = $this->product_model->get_paginated_user_pending_products($data["user"]->id, '1000000000000000000', '0');
        $data['mhidden_products'] = $this->product_model->get_paginated_user_hidden_products($data["user"]->id, '1000000000000000000', '0');
        $data['mdraft_products'] = $this->product_model->get_hkm_user_drafts($data["user"]->id, '1000000000000000000', '0');
        $data["mfavorites_products"] = $this->product_model->get_user_favorited_products($data["user"]->id);
        $data['mitems'] = $this->product_model->get_paginated_user_downloads($data["user"]->id, '1000000000000000000', '0');
        $data["muser_session"] = get_user_session();
        $data["mfollowers"] = $this->profile_model->get_followers($data["user"]->id);
        $data["mfollowing_users"] = $this->profile_model->get_following_users($data["user"]->id);
        $data["mreviews"] = $this->user_review_model->get_reviews($data["user"]->id);
        $data['mreview_count'] = $this->user_review_model->get_review_count($data["user"]->id);
        $data['mreviews'] = $this->user_review_model->get_limited_reviews($data["user"]->id, 5);
        $data['mreview_limit'] = 5;
        $this->load->view('partials/_header', $data);
        $this->load->view('profile/pending_products', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Favorites
     */
    public function favorites($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);

        if (empty($data["user"])) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("favorites");
        $data['description'] = trans("favorites") . " - " . $this->app_name;
        $data['keywords'] = trans("favorites") . "," . $this->app_name;
        $data["active_tab"] = "favorites";
        $data["products"] = $this->product_model->get_user_favorited_products($data["user"]->id);
        $data["user_session"] = get_user_session();


        $this->load->view('partials/_header', $data);
        $this->load->view('profile/favorites', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Followers
     */
    public function followers($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }

        if (auth_check() && $data["user"]->id != $this->auth_user->id)
            redirect(lang_base_url() . 'profile/followers/' . $slug);


        $data['title'] = trans("followers");
        $data['description'] = trans("followers") . " - " . $this->app_name;
        $data['keywords'] = trans("followers") . "," . $this->app_name;
        $data["active_tab"] = "followers";
        $data["followers"] = $this->profile_model->get_followers($data["user"]->id);

        $this->load->view('partials/_header', $data);
        $this->load->view('profile/followers', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Following
     */
    public function following($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);

        if (empty($data["user"])) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("following");
        $data['description'] = trans("following") . " - " . $this->app_name;
        $data['keywords'] = trans("following") . "," . $this->app_name;
        $data["active_tab"] = "following";
        $data["following_users"] = $this->profile_model->get_following_users($data["user"]->id);

        $this->load->view('partials/_header', $data);
        $this->load->view('profile/following', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Reviews
     */
    public function reviews($slug)
    {
        $slug = decode_slug($slug);
        if ($this->general_settings->user_reviews != 1) {
            redirect(lang_base_url());
        }

        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        if ($data["user"]->role != 'admin' && $data["user"]->role != 'vendor') {
            redirect(lang_base_url());
        }

        if (auth_check() && $data["user"]->id != $this->auth_user->id)
            redirect(lang_base_url() . 'profile/reviews/' . $slug);


        $data['title'] = trans("reviews");
        $data['description'] = $data["user"]->username . " " . trans("reviews") . " - " . $this->app_name;
        $data['keywords'] = $data["user"]->username . " " . trans("reviews") . "," . $this->app_name;
        $data["active_tab"] = "reviews";
        $data["reviews"] = $this->user_review_model->get_reviews($data["user"]->id);

        $data['review_count'] = $this->user_review_model->get_review_count($data["user"]->id);
        $data['reviews'] = $this->user_review_model->get_limited_reviews($data["user"]->id, 5);
        $data['review_limit'] = 5;

        $this->load->view('partials/_header', $data);
        $this->load->view('profile/reviews', $data);
        $this->load->view('partials/_footer');
    }


    /**
     * Favorites
     */
    public function account_favorites($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("favorites");
        $data['description'] = trans("favorites") . " - " . $this->app_name;
        $data['keywords'] = trans("favorites") . "," . $this->app_name;
        $data["active_tab"] = "favorites";
        $data["products"] = $this->product_model->get_user_favorited_products($data["user"]->id);
        $data["user_session"] = get_user_session();

        $this->load->view('partials/_header', $data);
        $this->load->view('account/favorites', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Followers
     */
    public function account_followers($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("followers");
        $data['description'] = trans("followers") . " - " . $this->app_name;
        $data['keywords'] = trans("followers") . "," . $this->app_name;
        $data["active_tab"] = "followers";
        $data["followers"] = $this->profile_model->get_followers($data["user"]->id);

        $this->load->view('partials/_header', $data);
        $this->load->view('account/followers', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Following
     */
    public function account_following($slug)
    {
        $slug = decode_slug($slug);
        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("following");
        $data['description'] = trans("following") . " - " . $this->app_name;
        $data['keywords'] = trans("following") . "," . $this->app_name;
        $data["active_tab"] = "following";
        $data["following_users"] = $this->profile_model->get_following_users($data["user"]->id);

        $this->load->view('partials/_header', $data);
        $this->load->view('account/following', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Reviews
     */
    public function account_reviews($slug)
    {
        $slug = decode_slug($slug);
        if ($this->general_settings->user_reviews != 1) {
            redirect(lang_base_url());
        }

        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        if ($data["user"]->role != 'admin' && $data["user"]->role != 'vendor') {
            redirect(lang_base_url());
        }

        $data['title'] = get_shop_name($data["user"]) . " " . trans("reviews");
        $data['description'] = $data["user"]->username . " " . trans("reviews") . " - " . $this->app_name;
        $data['keywords'] = $data["user"]->username . " " . trans("reviews") . "," . $this->app_name;
        $data["active_tab"] = "reviews";
        $data["reviews"] = $this->user_review_model->get_reviews($data["user"]->id);

        $data['review_count'] = $this->user_review_model->get_review_count($data["user"]->id);
        $data['reviews'] = $this->user_review_model->get_limited_reviews($data["user"]->id, 5);
        $data['review_limit'] = 5;

        $this->load->view('partials/_header', $data);
        $this->load->view('account/reviews', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * seller info
     */
    public function seller_info($slug)
    {
        $slug = decode_slug($slug);
        if ($this->general_settings->user_reviews != 1) {
            redirect(lang_base_url());
        }

        $data["user"] = $this->auth_model->get_user_by_slug($slug);
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        if ($data["user"]->role != 'admin' && $data["user"]->role != 'vendor') {
            redirect(lang_base_url());
        }

        $data['title'] = get_shop_name($data["user"]) . " " . trans("reviews");
        $data['description'] = $data["user"]->username . " " . trans("reviews") . " - " . $this->app_name;
        $data['keywords'] = $data["user"]->username . " " . trans("reviews") . "," . $this->app_name;
        $data["active_tab"] = "seller_info";

        $this->load->view('partials/_header', $data);
        $this->load->view('account/seller_info', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Update Profile
     */
    public function settings()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $data['btn_string'] = '';
        $data['state_button'] = '';
        $data['title'] = trans("settings");
        $data['description'] = trans("settings") . " - " . $this->app_name;
        $data['keywords'] = trans("settings") . "," . $this->app_name;
        $data["user"] = user();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "update_profile";
        $data["user_session"] = get_user_session();

        $data["countries"] = $this->location_model->get_countries();
        $data["states"] = $this->location_model->get_states_by_country($data["user"]->country_id);
        $data["cities"] = $this->location_model->get_cities_by_state($data["user"]->state_id);
        if ($data['user']->country_id) {
            $data['btn_string'] = $this->location_model->get_btn_string($data['user']);
            $data['state_button'] = $this->location_model->get_state_button_string($data['user']);
        }

        $data['user_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['days_left'] = $this->membership_model->get_user_plan_remaining_days_count($data['user_plan']);

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/settings', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Update Profile
     */
    public function update_profile()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $data['btn_string'] = '';
        $data['state_button'] = '';
        $data['title'] = trans("update_profile");
        $data['description'] = trans("update_profile") . " - " . $this->app_name;
        $data['keywords'] = trans("update_profile") . "," . $this->app_name;
        $data["user"] = user();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "update_profile";
        $data["user_session"] = get_user_session();

        // $data["countries"] = $this->location_model->get_countries();
        // $data["states"] = $this->location_model->get_states_by_country($data["user"]->country_id);
        // $data["cities"] = $this->location_model->get_cities_by_state($data["user"]->state_id);
        // if ($data['user']->country_id) {
        //     $data['btn_string'] = $this->location_model->get_btn_string($data['user']);
        //     $data['state_button'] = $this->location_model->get_state_button_string($data['user']);
        // }

        $data["countries"] = $this->location_model->get_countries();
        if ($data["user"]->country_id)
            $data["states"] = $this->location_model->get_states_by_country($data["user"]->country_id);
        else
            $data["states"] = $this->location_model->get_states_by_country($this->general_settings->default_product_location);
        $data["cities"] = $this->location_model->get_cities_by_state($data["user"]->state_id);

        if ($data['user']->country_id) {
            $data['btn_string'] = $this->location_model->get_btn_string($data['user']);
            $data['state_button'] = $this->location_model->get_state_button_string($data['user']);
        }
        $data['user_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['days_left'] = $this->membership_model->get_user_plan_remaining_days_count($data['user_plan']);

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/update_profile', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Update Profile Post
     */
    public function update_profile_post()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        // print_r($this->input->post()); exit;
        $user_id = user()->id;
        $action = $this->input->post('submit', true);

        if ($action == "resend_activation_email") {
            //send activation email
            $this->load->model("email_model");
            $this->email_model->send_email_activation($user_id);
            $this->session->set_flashdata('success', trans("msg_send_confirmation_email"));
            redirect($this->agent->referrer());
        }

        //validate inputs
        $this->form_validation->set_rules('firstname', trans("username"), 'required|xss_clean|max_length[255]');
        $this->form_validation->set_rules('lastname', trans("username"), 'required|xss_clean|max_length[255]');
        $this->form_validation->set_rules('email', trans("email"), 'required|xss_clean');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            redirect($this->agent->referrer());
        } else {

            $data = array(
                'firstname' => $this->input->post('firstname', true),
                'lastname' => $this->input->post('lastname', true),
                'username' => $this->input->post('firstname', true) . ' ' . $this->input->post('lastname', true),
                'shop_name' => $this->input->post('shop_name', true) ? $this->input->post('shop_name', true) : $this->input->post('firstname', true) . ' ' . $this->input->post('lastname', true),
                'slug' => str_slug($this->input->post('slug', true)),
                'email' => $this->input->post('email', true),
                'about_me' => $this->input->post('about_me', true),
                'send_email_when_item_sold' => $this->input->post('send_email_when_item_sold', true),
                'show_rss_feeds' => $this->input->post('show_rss_feeds', true),
                'send_email_new_message' => $this->input->post('send_email_new_message', true),
                'country_id' => $this->input->post('country_id', true),
                'state_id' => $this->input->post('state_id', true),
                'city_id' => $this->input->post('city_id', true),
                'address' => $this->input->post('address', true),
                'zip_code' => $this->input->post('zip_code', true),
                'phone_number' => $this->input->post('phone_number', true),
                'show_email' => $this->input->post('show_email', true),
                'show_phone' => $this->input->post('show_phone', true),
                'show_location' => $this->input->post('show_location', true)
            );

            //is email unique
            if (!$this->auth_model->is_unique_email($data["email"], $user_id)) {
                $this->session->set_flashdata('error', trans("msg_email_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }
            //is username unique
            // if (!$this->auth_model->is_unique_username($data["username"], $user_id)) {
            //     $this->session->set_flashdata('error', trans("msg_username_unique_error"));
            //     redirect($this->agent->referrer());
            //     exit();
            // }
            //is slug unique
            if ($this->auth_model->check_is_slug_unique($data["slug"], $user_id)) {
                $this->session->set_flashdata('error', trans("msg_slug_unique_error"));
                redirect($this->agent->referrer());
                exit();
            }

            if ($this->profile_model->update_profile($data, $user_id)) {
                $this->session->set_flashdata('success', trans("msg_updated"));
                //check email changed
                if ($this->profile_model->check_email_updated($user_id)) {
                    $this->session->set_flashdata('success', trans("msg_send_confirmation_email"));
                }
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Shop Settings
     */
    public function shop_settings()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("shop_settings");
        $data['description'] = trans("shop_settings") . " - " . $this->app_name;
        $data['keywords'] = trans("shop_settings") . "," . $this->app_name;
        $data["user"] = user();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "shop_settings";
        $data["user_session"] = get_user_session();
        $this->load->view('partials/_header', $data);
        $this->load->view('settings/shop_settings', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Shop Settings Post
     */
    public function shop_settings_post()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }
        if ($this->profile_model->update_shop_settings()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            redirect($this->agent->referrer());
        }
    }


    /**
     * Contact Informations
     */
    public function contact_informations()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("contact_informations");
        $data['description'] = trans("contact_informations") . " - " . $this->app_name;
        $data['keywords'] = trans("contact_informations") . "," . $this->app_name;
        $data["user"] = user();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "contact_informations";
        $data["countries"] = $this->location_model->get_countries();
        if ($data["user"]->country_id)
            $data["states"] = $this->location_model->get_states_by_country($data["user"]->country_id);
        else
            $data["states"] = $this->location_model->get_states_by_country($this->general_settings->default_product_location);
        $data["cities"] = $this->location_model->get_cities_by_state($data["user"]->state_id);
        $data["user_session"] = get_user_session();

        if ($data['user']->country_id) {
            $data['btn_string'] = $this->location_model->get_btn_string($data['user']);
            $data['state_button'] = $this->location_model->get_state_button_string($data['user']);
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/contact_informations', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Contact Informations Post
     */
    public function contact_informations_post()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        if ($this->profile_model->update_contact_informations()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Shipping Address
     */
    public function shipping_address()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }
        $data['title'] = trans("shipping_address");
        $data['description'] = trans("shipping_address") . " - " . $this->app_name;
        $data['keywords'] = trans("shipping_address") . "," . $this->app_name;
        $data["user"] = user();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "shipping_address";
        $data["countries"] = $this->location_model->get_countries();
        $data["user_session"] = get_user_session();
        $data['user_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['days_left'] = $this->membership_model->get_user_plan_remaining_days_count($data['user_plan']);

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/shipping_address', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Shipping Address Post
     */
    public function shipping_address_post()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        if ($this->profile_model->update_shipping_address()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Social Media
     */
    public function social_media()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("social_media");
        $data['description'] = trans("social_media") . " - " . $this->app_name;
        $data['keywords'] = trans("social_media") . "," . $this->app_name;
        $data["user"] = user();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "social_media";
        $data["user_session"] = get_user_session();
        $this->load->view('partials/_header', $data);
        $this->load->view('settings/social_media', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Social Media Post
     */
    public function social_media_post()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        if ($this->profile_model->update_social_media()) {
            $this->session->set_flashdata('success', trans("msg_updated"));
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
        redirect($this->agent->referrer());
    }

    /**
     * Change Password
     */
    public function change_password()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $data['title'] = trans("change_password");
        $data['description'] = trans("change_password") . " - " . $this->app_name;
        $data['keywords'] = trans("change_password") . "," . $this->app_name;
        $data["user"] = user();
        if (empty($data["user"])) {
            redirect(lang_base_url());
        }
        $data["active_tab"] = "change_password";
        $data['user_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['days_left'] = $this->membership_model->get_user_plan_remaining_days_count($data['user_plan']);

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/change_password', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Change Password Post
     */
    public function change_password_post()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $old_password_exists = $this->input->post('old_password_exists', true);

        if ($old_password_exists == 1) {
            $this->form_validation->set_rules('old_password', trans("old_password"), 'required|xss_clean');
        }
        $this->form_validation->set_rules('password', trans("password"), 'required|xss_clean|min_length[4]|max_length[50]');
        $this->form_validation->set_rules('password_confirm', trans("password_confirm"), 'required|xss_clean|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->profile_model->change_password_input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->profile_model->change_password($old_password_exists)) {
                $this->session->set_flashdata('success', trans("msg_change_password_success"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', trans("msg_change_password_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    /**
     * Follow Unfollow User
     */
    public function follow_unfollow_user()
    {
        //check user
        if (!auth_check()) {
            redirect(lang_base_url());
        }

        $this->profile_model->follow_unfollow_user();
        redirect($this->agent->referrer());
    }

    /**
     * Renew Membership Plan
     */
    public function membership_plan()
    {
        get_method();

        if ($this->general_settings->email_verification == 1 && $this->auth_user->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(lang_base_url() . "settings/update-profile");
        }
        $data['title'] = trans("select_your_plan");
        $data['description'] = trans("select_your_plan") . " - " . $this->app_name;
        $data['keywords'] = trans("select_your_plan") . "," . $this->app_name;
        $data['request_type'] = "renew";
        $data["membership_plans"] = $this->membership_model->get_plans();
        // $data["index_settings"] = get_index_settings();
        $data['user_current_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['user_ads_count'] = $this->membership_model->get_user_ads_count($this->auth_user->id);
        $data['user_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['days_left'] = $this->membership_model->get_user_plan_remaining_days_count($data['user_plan']);
        $data['ads_left'] = $this->membership_model->get_user_plan_remaining_ads_count($data['user_plan']);
        
        $plan = $this->membership_model->get_plan($data['user_plan']->plan_id);
        $data['plan_title'] = $this->membership_model->get_membership_plan_title($plan);
        $data["active_tab"] = "membership_plan";

        $this->load->view('partials/_header', $data);
        $this->load->view('settings/shop_settings', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Renew Membership Plan
     */
    public function renew_membership_plan()
    {
        get_method();

        if ($this->general_settings->membership_plans_system != 1) {
            redirect(lang_base_url());
            exit();
        }

        if (!is_user_vendor()) {
            redirect(lang_base_url());
        }

        if ($this->general_settings->email_verification == 1 && $this->auth_user->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(lang_base_url() . "settings/update-profile");
        }
        $data['title'] = trans("select_your_plan");
        $data['description'] = trans("select_your_plan") . " - " . $this->app_name;
        $data['keywords'] = trans("select_your_plan") . "," . $this->app_name;
        $data['request_type'] = "renew";
        $data["membership_plans"] = $this->membership_model->get_plans();
        // $data["index_settings"] = get_index_settings();
        $data['user_current_plan'] = $this->membership_model->get_user_plan_by_user_id($this->auth_user->id);
        $data['user_ads_count'] = $this->membership_model->get_user_ads_count($this->auth_user->id);

        $this->load->view('partials/_header', $data);
        $this->load->view('product/select_membership_plan', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Renew Membership Plan Post
     */
    public function renew_membership_plan_post()
    {
        post_method();
        // if (!is_user_vendor()) {
        //     redirect(lang_base_url());
        // }
        if ($this->general_settings->email_verification == 1 && $this->auth_user->email_status != 1) {
            $this->session->set_flashdata('error', trans("msg_confirmed_required"));
            redirect(lang_base_url() . "settings/update-profile");
        }
        $plan_id = $this->input->post('plan_id');
        if (empty($plan_id)) {
            redirect($this->agent->referrer());
            exit();
        }
        $plan = $this->membership_model->get_plan($plan_id);
        if (empty($plan)) {
            redirect($this->agent->referrer());
            exit();
        }

        if ($plan->is_free == 1) {
            $this->membership_model->add_user_free_plan($plan, $this->auth_user->id);
            // redirect(generate_dash_url("shop_settings"));
            // exit();
        }

        $this->session->set_userdata('modesy_selected_membership_plan_id', $plan->id);
        $this->session->set_userdata('modesy_membership_request_type', "renew");
        redirect(lang_base_url() . "cart/payment-method?payment_type=membership");
    }
}
