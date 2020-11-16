<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->comment_limit = 6;
        $this->blog_paginate_per_page = 12;
        $this->promoted_products_limit = $this->general_settings->index_promoted_products_count;
    }

    /**
     * Index
     */
    public function index()
    {
        if (auth_check()) {
            // if (@$_COOKIE["redirect_url"] == "home" || !(@$_COOKIE["redirect_url"]))
            if (@$_COOKIE["redirect_url"] == "messages")
                redirect(lang_base_url() . "messages");
            else if (@$_COOKIE["redirect_url"] == "sell-now")
                redirect(lang_base_url() . "sell-now");
            else if (@$_COOKIE["redirect_url"] == "notifications")
                redirect(lang_base_url() . "notifications");
            else if (@$_COOKIE["redirect_url"] == "account")
                redirect(lang_base_url() . "account/" . $this->auth_user->slug);
            else if (@$_COOKIE["redirect_url"] == "cart")
                redirect(lang_base_url() . "cart");
            else if (@$_COOKIE["redirect_url"] == "favorites")
                redirect(lang_base_url() . "favorites/" . $this->auth_user->slug);
        }
        $data['title'] = $this->settings->homepage_title;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        $data['is_mobile_header'] = true;

        if ($this->general_settings->default_product_location != 0) {
            $data["is_hkm_one_country"] = true;
            $data["is_hkm_one_country_value"] = $this->general_settings->default_product_location;
        } else {
            $data["is_hkm_one_country"] = false;
        }

        //products
        $key = "latest_products";
        if ($this->default_location_id != 0) {
            $key = "latest_products_location_" . $this->default_location_id;
        }
        $data["latest_products"] = get_cached_data($key);
        if (empty($data["latest_products"])) {
            $data["latest_products"] = $this->product_model->get_products_limited($this->general_settings->index_latest_products_count);
            set_cache_data($key, $data["latest_products"]);
        }

        $data["promoted_products"] = $this->product_model->get_promoted_products();
        $data["promoted_products_count"] = $this->product_model->get_promoted_products_count();
        $data["promoted_products_limit"] = $this->promoted_products_limit;
        $data['site_settings'] = get_site_settings();
        $data["slider_items"] = $this->slider_model->get_slider_items();
        $data["categories"] = $this->category_model->get_categories_all();
        $data["states"] = get_states_by_country($this->default_location_id);
        if ($this->default_location_id == 0) {
            $data["states"] = get_states_by_country($this->location_model->default_country());
        }
        $capitalstate = array_filter($data["states"], function ($item) {
            return $item->is_capital;
        });
        $capitalstate = reset($capitalstate);
        $data["capital_state"] = $capitalstate;
        if ($capitalstate) {
            $data["cities"] = get_cities_by_state($capitalstate->id);
        } else {
            $data["cities"] = array();
        }
        $capitalcity = array_filter($data["cities"], function ($item) {
            return $item->is_default;
        });
        $capitalcity = reset($capitalcity);
        $data["capital_city"] = $capitalcity;
        $data['featured_category_count'] = $this->category_model->get_featured_categories_count();

        //blog slider posts
        $key = "blog_slider_posts_lang_" . $this->selected_lang->id;
        $data["blog_slider_posts"] = get_cached_data($key);
        if (empty($data["blog_slider_posts"])) {
            $data["blog_slider_posts"] = $this->blog_model->get_latest_posts(8);
            set_cache_data($key, $data["blog_slider_posts"]);
        }
        if (auth_check()) {
            $data["mfavorites_products"] = $this->product_model->get_user_favorited_products(user()->id);
        }
        $this->session->unset_userdata('mds_link_session');
        $this->session->unset_userdata('mds_link_type_session');
        $this->session->unset_userdata('mds_action_link_session');
        $this->session->unset_userdata('mds_current_url_session');
        $this->session->unset_userdata('mds_location_type_session');
        $this->session->unset_userdata('mds_location_data_session');

        $footer['is_exist'] = true;
        $this->load->view('partials/_header', $data);
        $this->load->view('index', $data);
        $this->load->view('partials/_footer', $footer);
    }


    /**
     * Contact
     */
    public function contact()
    {
        $data['title'] = trans("contact");
        $data['description'] = trans("contact") . " - " . $this->app_name;
        $data['keywords'] = trans("contact") . "," . $this->app_name;
        $data['site_settings'] = get_site_settings();
        $this->load->view('partials/_header', $data);
        $this->load->view('contact', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Contact Page Post
     */
    public function contact_post()
    {
        post_method();
        //validate inputs
        $this->form_validation->set_rules('name', trans("name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('email', trans("email_address"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('message', trans("message"), 'required|xss_clean|max_length[5000]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->contact_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if (!$this->recaptcha_verify_request()) {
                $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                $this->session->set_flashdata('error', trans("msg_recaptcha"));
                redirect($this->agent->referrer());
            } else {
                if ($this->contact_model->add_contact_message()) {
                    $this->session->set_flashdata('success', trans("msg_contact_success"));
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('form_data', $this->contact_model->input_values());
                    $this->session->set_flashdata('error', trans("msg_contact_error"));
                    redirect($this->agent->referrer());
                }
            }
        }
    }

    /**
     * Dynamic Page by Name Slug
     */
    public function any($slug)
    {
        $slug = decode_slug($slug);
        //index page
        if (empty($slug)) {
            redirect(lang_base_url());
        }

        $data['page'] = $this->page_model->get_page($slug);
        $data['site_settings'] = get_site_settings();
        //if exists
        if (!empty($data['page'])) {
            if ($data['page']->visibility == 0) {
                $this->error_404();
            } else {
                $data['title'] = $data['page']->title;
                $data['description'] = $data['page']->description;
                $data['keywords'] = $data['page']->keywords;

                $this->load->view('partials/_header', $data);
                $this->load->view('page', $data);
                $this->load->view('partials/_footer');
            }
        } else {
            $this->product($slug);
        }
    }

    /**
     * Product
     */
    public function product($slug)
    {
        $this->review_limit = 5;
        $this->comment_limit = 5;
        $data["product"] = $this->product_model->get_product_by_slug($slug);
        if (empty($data['product'])) {
            $this->error_404();
        } else {
            if ($data['product']->status == 0 || $data['product']->visibility == 0) {
                if (!auth_check()) {
                    redirect(lang_base_url());
                }
                if ($data['product']->user_id != user()->id && user()->role != "admin") {
                    redirect(lang_base_url());
                }
            }

            $data["page"] = "detail_product";
            $data["categories"] = $this->category_model->get_all_parent_categories($data["product"]->category_id);

            $data["subcategory"] = $this->category_model->get_category_joined($data["product"]->subcategory_id);
            $data["third_category"] = $this->category_model->get_category_joined($data["product"]->third_category_id);
            //images
            $data["product_images"] = $this->file_model->get_product_images($data["product"]->id);

            //related products
            $key = "related_products_" . $data["product"]->id;
            $data["related_products"] = get_cached_data($key);
            if (empty($data["related_products"])) {
                $data["related_products"] = $this->product_model->get_related_products($data["product"]);
                set_cache_data($key, $data["related_products"]);
            }

            $data["user"] = $this->auth_model->get_user($data["product"]->user_id);

            //user products
            $key = 'more_products_by_user_' . $data["user"]->id . 'cache';
            $data['user_products'] = get_cached_data($key);
            if (empty($data['user_products'])) {
                $data["user_products"] = $this->product_model->get_user_products($data["user"]->slug, 3, $data["product"]->id);
                set_cache_data($key, $data['user_products']);
            }

            $data['review_count'] = $this->review_model->get_review_count($data["product"]->id);
            $data['reviews'] = $this->review_model->get_limited_reviews($data["product"]->id, $this->review_limit);
            $data['review_limit'] = $this->review_limit;

            $data['comment_count'] = $this->comment_model->get_product_comment_count($data["product"]->id);
            $data['comments'] = $this->comment_model->get_comments($data["product"]->id, $this->comment_limit);
            $data['comment_limit'] = $this->comment_limit;
            $data["custom_fields"] = $this->field_model->generate_custom_fields_array($data["product"]->category_id, $data["product"]->id);
            $data["half_width_product_variations"] = $this->variation_model->get_half_width_product_variations($data["product"]->id, $this->selected_lang->id);
            $data["full_width_product_variations"] = $this->variation_model->get_full_width_product_variations($data["product"]->id, $this->selected_lang->id);

            $data["video"] = $this->file_model->get_product_video($data["product"]->id);
            $data["audio"] = $this->file_model->get_product_audio($data["product"]->id);

            $data["digital_sale"] = null;
            if ($data["product"]->product_type == 'digital' && $this->auth_check) {
                $data["digital_sale"] = get_digital_sale_by_buyer_id($this->auth_user->id, $data["product"]->id);
            }
            // exit("here");
            //og tags
            $data['show_og_tags'] = true;
            $data['og_title'] = $data['product']->title;
            $description_text = trim(html_escape(strip_tags($data['product']->description)));
            $data['og_description'] = character_limiter($description_text, 200, "");
            $data['og_type'] = "article";
            $data['og_url'] = lang_base_url() . $data['product']->slug;
            $data['og_image'] = get_product_image($data['product']->id, 'image_default');
            $data['og_width'] = "750";
            $data['og_height'] = "500";
            if (!empty($data['user'])) {
                $data['og_creator'] = $data['user']->username;
                $data['og_author'] = $data['user']->username;
            } else {
                $data['og_creator'] = "";
                $data['og_author'] = "";
            }
            $data['og_published_time'] = $data['product']->created_at;
            $data['og_modified_time'] = $data['product']->created_at;

            $data['title'] = $data['product']->title;
            $data['description'] = character_limiter($description_text, 200, "");
            $data['keywords'] = generate_product_keywords($data['product']->title);

            $this->load->model('upload_model');
            // print_r($data); exit;
            $this->load->view('partials/_header', $data);
            $this->load->view('product/details/product', $data);
            $this->load->view('partials/_footer');
            //increase hit
            $this->product_model->increase_product_hit($data["product"]);
        }
    }

    /**
     * Load More Promoted Products
     */
    public function load_more_promoted_products()
    {
        $data["limit"] = $this->input->post("limit", true);
        $data["new_limit"] = $data["limit"] + $this->promoted_products_limit;
        $data["promoted_products"] = $this->product_model->get_promoted_products();
        $this->load->view('product/_promoted_product_item_response', $data);
    }


    /**
     * Load More Promoted Products
     */
    public function images()
    {
        $data = func_get_args();
        if (count($data) == 4) {
            $img = $data[3];
            $size = $data[0];
            $folder = $data[2];

            $this->load->model('upload_model');
            $path = FCPATH . $this->upload_model->update_watermark($img, $size, $folder);

            try {
                $file = $path;
                $type = 'image/png';
                if (file_exists($file) && !is_dir($file)) {
                    header('Content-Type:' . $type);
                    header('Content-Length: ' . filesize($file));
                    $homepage = file_get_contents($file);
                    echo $homepage;
                } else
                    echo 'No Image to Show you';
            } catch (Exception $e) {
                echo 'No Image to Show you';
            }
        }
    }

    /**
     * Search
     */
    public function search()
    {
        $search = trim($this->input->get('search', TRUE));
        $search_type = $this->input->get('search_type', TRUE);
        $search = remove_special_characters($search);

        if (empty($search)) {
            redirect(lang_base_url());
        }

        if ($search_type == 'product') {
            redirect(lang_base_url() . 'products?search=' . $search);
        } else {
            redirect(lang_base_url() . 'members?search=' . $search);
        }
    }

    /**
     * Members
     */
    public function members()
    {
        $search = trim($this->input->get('search', TRUE));
        $search = remove_special_characters($search);

        if (empty($search)) {
            redirect(lang_base_url());
        }

        $data["members"] = $this->profile_model->search_members($search);

        $data['title'] = $search . " - " . trans("members");
        $data['description'] = $search . " - " . trans("members") . " - " . $this->app_name;
        $data['keywords'] = $search . ", " . trans("members") . "," . $this->app_name;

        $data['filter_search'] = $this->input->get("search");
        $data['search_type'] = "member";

        $this->load->view('partials/_header', $data);
        $this->load->view('members', $data);
        $this->load->view('partials/_footer');
    }



    /*
    *-------------------------------------------------------------------------------------------------
    * BLOG PAGES
    *-------------------------------------------------------------------------------------------------
    */

    /**
     * Blog
     */
    public function blog()
    {
        $data['title'] = trans("blog");
        $data['description'] = trans("blog") . " - " . $this->app_name;
        $data['keywords'] = trans("blog") . "," . $this->app_name;
        $data["active_category"] = "all";
        $key = "blog_posts_count_lang_" . $this->selected_lang->id;
        $blog_posts_count = get_cached_data($key);
        if (empty($blog_posts_count)) {
            $blog_posts_count = $this->blog_model->get_posts_count();
            set_cache_data($key, $blog_posts_count);
        }
        $data['site_settings'] = get_site_settings();
        //set pagination
        $pagination = $this->paginate(lang_base_url() . 'blog', $blog_posts_count, $this->blog_paginate_per_page);
        $key = 'blog_posts_lang_' . $this->selected_lang->id . '_page_' . $pagination['current_page'];
        $data['posts'] = get_cached_data($key);
        if (empty($data['posts'])) {
            $data['posts'] = $this->blog_model->get_paginated_posts($pagination['per_page'], $pagination['offset']);
            set_cache_data($key, $data['posts']);
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Category
     */
    public function category($slug)
    {
        $slug = decode_slug($slug);
        $data["category"] = $this->blog_category_model->get_category_by_slug($slug);

        if (empty($data["category"])) {
            redirect(lang_base_url() . "blog");
        }

        $data['title'] = $data["category"]->name;
        $data['description'] = $data["category"]->description;
        $data['keywords'] = $data["category"]->keywords;
        $data["active_category"] = $slug;
        $data['site_settings'] = get_site_settings();
        $key = "blog_category_" . $data["category"]->id . "_posts_count_lang_" . $this->selected_lang->id;
        $blog_posts_count = get_cached_data($key);
        if (empty($blog_posts_count)) {
            $blog_posts_count = count($this->blog_model->get_posts_by_category($data["category"]->id));
            set_cache_data($key, $blog_posts_count);
        }

        //set pagination
        $pagination = $this->paginate(lang_base_url() . 'blog/' . $data["category"]->slug, $blog_posts_count, $this->blog_paginate_per_page);
        $key = 'blog_category_' . $data["category"]->id . 'posts_lang_' . $this->selected_lang->id . '_page_' . $pagination['current_page'];
        $data['posts'] = get_cached_data($key);
        if (empty($data['posts'])) {
            $data['posts'] = $this->blog_model->get_paginated_category_posts($pagination['per_page'], $pagination['offset'], $data["category"]->id);
            set_cache_data($key, $data['posts']);
        }

        $this->load->view('partials/_header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Tag
     */
    public function tag($slug)
    {
        $slug = decode_slug($slug);
        $data['tag'] = $this->tag_model->get_post_tag($slug);

        if (empty($data['tag'])) {
            redirect(lang_base_url() . "blog");
        }

        $data['title'] = $data['tag']->tag;
        $data['description'] = trans("tag") . ": " . $data['tag']->tag . " - " . $this->app_name;
        $data['keywords'] = trans("tag") . "," . $data['tag']->tag . "," . $this->app_name;
        //get paginated posts
        $pagination = $this->paginate(lang_base_url() . 'blog/tag/' . $data['tag']->tag_slug, $this->blog_model->get_paginated_tag_posts_count($data['tag']->tag_slug), $this->blog_paginate_per_page);
        $data['posts'] = $this->blog_model->get_paginated_tag_posts($pagination['per_page'], $pagination['offset'], $data['tag']->tag_slug);
        $data['site_settings'] = get_site_settings();
        $this->load->view('partials/_header', $data);
        $this->load->view('blog/tag', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Post
     */
    public function post($category_slug, $slug)
    {
        $slug = decode_slug($slug);
        $data["post"] = $this->blog_model->get_post_by_slug($slug);

        if (empty($data["post"])) {
            redirect(lang_base_url() . "blog");
        }

        $data['title'] = $data["post"]->title;
        $data['description'] = $data["post"]->summary;
        $data['keywords'] = $data["post"]->keywords;

        $data['related_posts'] = $this->blog_model->get_related_posts($data['post']->category_id, $data["post"]->id);
        $data['latest_posts'] = $this->blog_model->get_latest_posts(3);
        $data['random_tags'] = $this->tag_model->get_random_post_tags();
        $data['post_tags'] = $this->tag_model->get_post_tags($data["post"]->id);
        $data['comments'] = $this->comment_model->get_blog_comments($data["post"]->id, $this->comment_limit);
        $data['comment_limit'] = $this->comment_limit;
        $data['post_user'] = $this->auth_model->get_user($data['post']->user_id);
        $data["category"] = $this->blog_category_model->get_category($data['post']->category_id);
        //og tags
        $data['show_og_tags'] = true;
        $data['og_title'] = $data['post']->title;
        $data['og_description'] = $data['post']->summary;
        $data['og_type'] = "article";
        $data['og_url'] = lang_base_url() . "blog/" . $data['post']->category_slug . "/" . $data['post']->slug;
        $data['og_image'] = get_blog_image_url($data['post'], 'image_default');
        $data['site_settings'] = get_site_settings();
        $data['og_width'] = "750";
        $data['og_height'] = "500";
        if (!empty($data['post_user'])) {
            $data['og_creator'] = $data['post_user']->username;
            $data['og_author'] = $data['post_user']->username;
        } else {
            $data['og_creator'] = "";
            $data['og_author'] = "";
        }
        $data['og_published_time'] = $data['post']->created_at;
        $data['og_modified_time'] = $data['post']->created_at;
        $data['og_tags'] = $data['post_tags'];

        $this->load->view('partials/_header', $data);
        $this->load->view('blog/post', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Guest Favorites
     */
    public function guest_favorites()
    {
        $data['title'] = trans("favorites");
        $data['description'] = trans("favorites") . " - " . $this->app_name;
        $data['keywords'] = trans("favorites") . "," . $this->app_name;
        $data['favorites'] = $this->session->userdata('mds_guest_favorites');

        $this->load->view('partials/_header', $data);
        $this->load->view('guest_favorites', $data);
        $this->load->view('partials/_footer');
    }

    /**
     * Unsubscribe
     */
    public function unsubscribe()
    {
        $data['title'] = trans("unsubscribe");
        $data['description'] = trans("unsubscribe");
        $data['keywords'] = trans("unsubscribe");

        $token = $this->input->get("token");
        $token = remove_special_characters($token);
        $subscriber = $this->newsletter_model->get_subscriber_by_token($token);

        if (empty($subscriber)) {
            redirect(lang_base_url());
        }
        $this->newsletter_model->unsubscribe_email($subscriber->email);

        $this->load->view('partials/_header', $data);
        $this->load->view('unsubscribe');
        $this->load->view('partials/_footer');
    }

    /**
     * Add to Subscribers
     */
    public function add_to_subscribers()
    {
        //input values
        $email = $this->input->post('email', true);

        if ($email) {
            //check if email exists
            if (empty($this->newsletter_model->get_subscriber($email))) {
                //addd
                if ($this->newsletter_model->add_to_subscribers($email)) {
                    $this->session->set_flashdata('news_success', trans("msg_newsletter_success"));
                }
            } else {
                $this->session->set_flashdata('news_error', trans("msg_newsletter_error"));
            }
        }
        redirect($this->agent->referrer() . "#newsletter");
    }

    /**
     * Add Comment
     */
    public function add_comment_post()
    {
        if ($this->general_settings->blog_comments != 1) {
            exit();
        }
        $post_id = $this->input->post('post_id', true);
        $limit = $this->input->post('limit', true);
        if (auth_check()) {
            $this->comment_model->add_blog_comment();
        } else {
            if ($this->recaptcha_verify_request()) {
                $this->comment_model->add_blog_comment();
            }
        }

        $data["comments"] = $this->comment_model->get_blog_comments($post_id, $limit);
        $data["comment_post_id"] = $post_id;
        $data['comment_limit'] = $limit;

        $this->load->view("blog/_blog_comments", $data);
    }

    /**
     * Delete Comment
     */
    public function delete_comment_post()
    {
        $comment_id = $this->input->post('comment_id', true);
        $post_id = $this->input->post('post_id', true);
        $limit = $this->input->post('limit', true);

        $comment = $this->comment_model->get_blog_comment($comment_id);
        if (auth_check() && !empty($comment)) {
            if (user()->role == "admin" || user()->id == $comment->user_id) {
                $this->comment_model->delete_blog_comment($comment_id);
            }
        }

        $data["comments"] = $this->comment_model->get_blog_comments($post_id, $limit);
        $data["comment_post_id"] = $post_id;
        $data['comment_limit'] = $limit;

        $this->load->view("blog/_blog_comments", $data);
    }

    /**
     * Load Comment
     */
    public function load_more_comment()
    {
        $post_id = $this->input->post('post_id', true);
        $limit = $this->input->post('limit', true);
        $new_limit = $limit + $this->comment_limit;

        $data["comments"] = $this->comment_model->get_blog_comments($post_id, $new_limit);
        $data["comment_post_id"] = $post_id;
        $data['comment_limit'] = $new_limit;

        $this->load->view("blog/_blog_comments", $data);
    }

    //set site language
    public function set_site_language()
    {
        $lang_id = $this->input->post('lang_id', true);
        $this->session->set_userdata("modesy_selected_lang", $lang_id);
    }

    public function cookies_warning()
    {
        setcookie('modesy_cookies_warning', '1', time() + (86400 * 10), "/"); //10 days
    }

    public function set_default_location()
    {
        $location_id = $this->input->post('location_id', true);
        if ($location_id == "all") {
            if (!empty($this->session->userdata('modesy_default_location'))) {
                $this->session->unset_userdata('modesy_default_location');
            }
        } else {
            $this->session->set_userdata('modesy_default_location', $location_id);
        }
    }

    public function error_404()
    {
        $data['title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";
        $this->load->view('partials/_header', $data);
        $this->load->view('errors/error_404');
        $this->load->view('partials/_footer');
    }

    public function location()
    {
        $country_id = clean_number($this->input->get("country", true));
        $state_id = clean_number($this->input->get("state", true));
        $city_id = clean_number($this->input->get("city", true));
        $current_url = $this->input->get("current_url", true);
        if ($current_url)
            $this->session->set_userdata('mds_current_url_session', $current_url);

        $data['title'] = $this->settings->homepage_title;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        if (!$country_id) {
            $data['locations'] = get_countries();
            $data['location_type'] = 'country';
        } else if ($country_id && !$state_id) {
            $data['locations'] = get_states_by_country($country_id);
            $data['location_type'] = 'state';
        } else if ($country_id && $state_id && !$city_id) {
            $data['locations'] = get_cities_by_state($state_id);
            $data['location_type'] = 'city';
        }
        $data['country'] = $country_id;
        $data['state'] = $state_id;
        $data['city'] = $city_id;

        $this->load->view('partials/_header', $data);
        $this->load->view('product/_popup_location_home', $data);
        $this->load->view('partials/_footer');
    }
}
