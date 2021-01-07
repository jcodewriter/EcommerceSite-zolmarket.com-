<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_controller extends Home_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->review_limit = 6;
        if ($this->input->is_ajax_request()) {
            $lang_base_url = $this->input->post('lang_base_url', true);
            if (!empty($lang_base_url)) {
                $lang_base_url = substr($lang_base_url, 0, -1);
                $lang_segments = explode('/', $lang_base_url);
                $lang_segment = end($lang_segments);
                $this->lang_base_url = $lang_base_url . "/";
                foreach ($this->languages as $lang) {
                    if ($lang_segment == $lang->short_form) {
                        if ($this->general_settings->multilingual_system == 1){
                            $this->selected_lang = $lang;
                        }
                    }
                }
            }
        }
    }

    //get subcategories
    public function get_subcategories()
    {
        $parent_id = $this->input->post('parent_id', true);
        $subcategories = $this->category_model->get_subcategories_by_parent_id($parent_id);
        foreach ($subcategories as $item) {
            echo '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
    }


    /*
    *------------------------------------------------------------------------------------------
    * SEARCH LOCATION
    *------------------------------------------------------------------------------------------
    */

    //search location
    public function search_location()
    {
        $parent_id = $this->input->post('parent', true);
        $type = $this->input->post('type', true);
        $mode = $this->input->post('mode', true);
        $default = '';
        $data = array(
            'result' => 0,
            'response' => ''
        );

        $data = array();

        switch ($type) {

            case "country":
                $data = $this->location_model->get_countries();
                $default = 'countires_all';
                break;


            case "state":
                $data = $this->location_model->get_states_by_country($parent_id);
                $default = 'states_all';
                break;


            case "city":
                $data = $this->location_model->get_cities_by_state($parent_id);
                $default = 'cities_all';
                break;
        }
        if ($mode != "option")
            echo $this->GenerateHtmlMobileMenu("location", $data);
        else {
            echo '<option value="">' . trans($default) . '</option>';

            foreach ($data as $item)
                if ($default == "states_all")
                    echo '<option value="' . $item->id . '" data-capital="' . $item->is_capital  . '" >' . $item->name . '</option>';
                else
                    echo '<option value="' . $item->id . '" >' . $item->name . '</option>';
        }
    }

    //get states
    public function get_states()
    {
        $country_id = $this->input->post('country_id', true);
        $states = $this->location_model->get_states_by_country($country_id);
        $status = 0;
        $content = '';
        if (!empty($states)) {
            $status = 1;
            $content = '<option value="">' . trans("state") . '</option>';
            foreach ($states as $item) {
                $content .= '<option value="' . $item->id . '">' . html_escape($item->name) . '</option>';
            }
        }
        $data = array(
            'result' => $status,
            'content' => $content
        );
        echo json_encode($data);
    }

    //get cities
    public function get_cities()
    {
        $state_id = $this->input->post('state_id', true);
        $cities = $this->location_model->get_cities_by_state($state_id);
        $status = 0;
        $content = '';
        if (!empty($cities)) {
            $status = 1;
            $content = '<option value="">' . trans("city") . '</option>';
            foreach ($cities as $item) {
                $content .= '<option value="' . $item->id . '">' . html_escape($item->name) . '</option>';
            }
        }
        $data = array(
            'result' => $status,
            'content' => $content
        );
        echo json_encode($data);
    }

    //search location
    public function filter_location()
    {
        $parent_id = $this->input->post('parent', true);
        $type = $this->input->post('type', true);
        $mode = $this->input->post('mode', true);
        $default = '';
        $data = array(
            'result' => 0,
            'response' => ''
        );

        $data = array();

        switch ($type) {

            case "country":
                $data = $this->location_model->get_countries();
                $default = 'countires_all';
                break;


            case "state":
                $data = $this->location_model->get_states_by_country($parent_id);
                $default = 'states_all';
                break;


            case "city":
                $data = $this->location_model->get_cities_by_state($parent_id);
                $default = 'cities_all';
                break;
        }
        if ($mode != "option")
            echo $this->GenerateHtmlMobileMenu("filter_location", $data);
        else {
            echo '<option value="">' . trans($default) . '</option>';

            foreach ($data as $item)
                if ($default == "states_all")
                    echo '<option value="' . $item->id . '" data-capital="' . $item->is_capital  . '" >' . $item->name . '</option>';
                else
                    echo '<option value="' . $item->id . '" >' . $item->name . '</option>';
        }
    }


    public function custom_location()
    {
        $parent_id = $this->input->post('parent', true);
        $custom_country_id = $this->input->post('custom_country_id', true);
        $type = $this->input->post('type', true);
        $mode = $this->input->post('mode', true);
        // echo $custom_country_id; exit;
        $default = '';
        $data = array(
            'result' => 0,
            'response' => ''
        );
        // print_r($this->general_settings->default_product_location); exit;
        
        $data = array();

        switch ($type) {

            case "country_id":
                if ($this->general_settings->default_product_location)
                    $data = $this->location_model->get_country_data($this->general_settings->default_product_location);
                else
                    $data = $this->location_model->get_countries();
                $default = 'countires_all';
                break;


            case "state_id":
                $data = $this->location_model->get_states_by_country1($custom_country_id);
                $default = 'states_all';
                break;


            case "city_id":
                $data = $this->location_model->get_cities_by_state($custom_country_id);
                $default = 'cities_all';
                break;
        }
        if ($mode != "option")
            echo $this->GenerateHtmlMobileMenu("custom_location", $data);
        else {
            echo '<option value="">' . trans($default) . '</option>';

            foreach ($data as $item)
                if ($default != "states_all")
                    echo '<option value="' . $item->id . '" data-capital="' . $item->is_capital  . '" >' . $item->name . '</option>';
                else
                    echo '<option value="' . $item->id . '" >' . $item->name . '</option>';
        }
    }

    public function country_location()
    {
        $data = array();
        $data = $this->location_model->get_countries();
        echo $this->GenerateHtmlMobileMenu("country_location", $data);
    }

    /*
    *------------------------------------------------------------------------------------------
    * USER REVIEW FUNCTIONS
    *------------------------------------------------------------------------------------------
    */

    //add user review
    public function add_user_review()
    {
        if ($this->general_settings->user_reviews != 1) {
            exit();
        }
        $seller_id = $this->input->post('seller_id', true);
        $review = $this->user_review_model->get_review_by_user($seller_id, user()->id);
        if (!empty($review)) {
            echo "voted_error";
        } else {
            $this->user_review_model->add_review();
        }
    }

    //load more review
    public function load_more_user_review()
    {
        $seller_id = $this->input->post('seller_id', true);
        $limit = $this->input->post('limit', true);
        $new_limit = $limit + $this->review_limit;
        $data["user"] = $this->auth_model->get_user($seller_id);
        $data["reviews"] = $this->user_review_model->get_limited_reviews($seller_id, $new_limit);
        $data['review_count'] = $this->user_review_model->get_review_count($seller_id);
        $data['review_limit'] = $new_limit;

        $this->load->view('profile/_user_reviews', $data);
    }

    //delete user review
    public function delete_user_review()
    {
        $id = $this->input->post('review_id', true);
        $this->user_review_model->delete_review($id);
    }


    // set captial state
    public function set_state_capital()
    {
        post_method();
        $valide = $this->location_model->set_state_capital();
        if ($valide)
            echo json_encode(['status' => 200, 'message' => 'Changes Sucesss']);
        else
            echo json_encode(['status' => 400, 'message' => 'Changes Failed']);
    }

    public function set_country_default()
    {
        post_method();
        $valide = $this->location_model->set_country_default();
        if ($valide)
            echo json_encode(['status' => 200, 'message' => 'Changes Sucesss']);
        else
            echo json_encode(['status' => 400, 'message' => 'Changes Failed']);
    }


    public function set_city_default()
    {
        post_method();
        $valide = $this->location_model->set_city_default();
        if ($valide)
            echo json_encode(['status' => 200, 'message' => 'Changes Sucesss']);
        else
            echo json_encode(['status' => 400, 'message' => 'Changes Failed']);
    }


    /* You can search in ob_start and  ob_get_clean in php documentation */
    public function getcategories()
    {
        echo $this->GenerateHtmlMobileMenu("category", array());
    }

    public function filter_categories()
    {
        echo $this->GenerateHtmlMobileMenu("filter", array());
    }

    public function special_categories(){
        echo $this->GenerateHtmlMobileMenu("special_category", array());
    }

    public function admin_categories(){
        echo $this->GenerateHtmlMobileMenu("admin_category", array());
    }

    public function mobile_filter(){
        $data = array();
        $result = explode('&', $_POST['query']);
        $data['items'] = $this->category_model->get_filter_items($result[0]);
        $data['type'] = $result[1];
        echo $this->GenerateHtmlMobileMenu("mobile_filter", $data);
    }


    /* You can search in ob_start and  ob_get_clean in php documentation */
    public function menu_search()
    {
        if ($this->input->post("search", true) != "") {
            $searchenglish = $this->ArabicToEnglish($this->input->post("search", true));
            $searcharabic = $this->EnglishToArabic($this->input->post("search", true));
            $data = array();
            $data["categories"] = $this->category_model->search_categories($this->input->post("search", true));
            $data["products"] = $this->product_model->search_products($searchenglish, $searcharabic, true);
            echo $this->GenerateHtmlMobileMenu("search", $data);
        }
        return "";
    }

    public function GenerateHtmlMobileMenu($type, $items)
    {
        ob_start();
        switch ($type) {
            case "location":
                include("menu/location.php");
                break;
            case "filter_location":
                include("menu/filter_location.php");
                break;    
            case "category":
                include("menu/cat.php");
                break;
            case "filter":
                include("menu/filter_category.php");
                break;
            case "search":
                include("menu/search.php");
                break;
            case "special_category":
                include("menu/specialcat.php");
                break;
            case "admin_category":
                include("menu/admincategory.php");
                break;    
            case "custom_location":
                include("menu/custom_location.php");
                break;
            case "country_location":
                include("menu/country_location.php");
                break;
            case "mobile_filter":
                include("menu/mobile_filter_menu.php");
                break;    
        }
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    /*
     * we'll use the suggested media usage romanization for these
     * http://www.al-bab.com/arab/language/roman1.htm
     */
    public function EnglishToArabic($source)
    {
        mb_internal_encoding("UTF-8");
        $x = "";
        // lowercase it all to start with
        //$source = strtolower($source);
        // start by looking for the 8 letters that have an approximate equivalent in arabic
        // these are B,F,K,L,M,N,R and Z
        // hack to pick out i 
        if (strlen($source) == 1) {
            if ($source == 'i') {
                $x .= "ا";
            }
        }
        // check for arabic chars in
        // remove all the vowels unless they're doubled up or u or ie
        $x .= " ";
        for ($i = 0; $i < strlen($source); $i++) {
            $char = substr($source, $i, 1);
            // check for arabic characters in the string and just output them if they exist
            if (ord(substr($source, 0, 1)) == 216 || ord(substr($source, 0, 1)) == 217) {
                $x .= substr($source, $i, 2);
                $i++;
                continue;
            }
            $char = strtolower($char);
            switch ($char) {
                case 'a':
                    $x .= 'ا'; // alif
                    break;
                case 'b':
                    $x .= 'ب'; // bah
                    break;
                case 'c':
                    $x .= 'ك'; // kah
                    break;
                case 'd':
                    $x .= 'د'; // dal
                    break;
                case 'e':
                    $x .= 'ي'; // yeh
                    break;
                case 'f':
                    $x .= 'ف'; // feh
                    break;
                case 'g':
                    $x .= 'ج'; // ghaim
                    break;
                case 'h':
                    $x .= 'ه'; // heh
                    break;
                case 'i':
                    $x .= 'ي'; // yeh
                    break;
                case 'j':
                    $x .= 'ج'; // jeem
                    break;
                case 'k':
                    $x .= 'ك'; // kaf
                    break;
                case 'l':
                    $x .= 'ل'; // lam
                    break;
                case 'm':
                    $x .= 'م'; // meem
                    break;
                case 'n':
                    $x .= 'ن'; // noon
                    break;
                case 'o':
                    $x .= 'و'; // waw
                    break;
                case 'p':
                    $x .= 'ب'; // beh
                    break;
                case 'q':
                    $x .= 'ك'; // kah
                    break;
                case 'r':
                    $x .= 'ر'; // reh
                    break;
                case 's':
                    $x .= 'س'; // seen
                    break;
                case 't':
                    $x .= 'ت'; // teh
                    break;
                case 'u':
                    $x .= 'و'; // waw
                    break;
                case 'v':
                    $x .= 'ف'; // veh
                    break;
                case 'w':
                    $x .= 'و'; // waw
                    break;
                case 'x':
                    $x .= 'كس'; // kaf and seen
                    break;
                case 'y':
                    $x .= 'ي'; // yeh
                    break;
                case 'z':
                    $x .= 'ز'; // zain
                    break;
                default:
                    $x .= $char;
                    break;
            }
        }
        return $x;
    }

    /*
     * we'll use the ALA-LC Romanization Tables for this
     * http://www.al-bab.com/arab/language/roman1.htm
     */
    public function ArabicToEnglish($source)
    {
        mb_internal_encoding("UTF-8");
        $x = " ";
        for ($i = 0; $i < strlen($source); $i++) {
            $byte1 = ord(substr($source, $i, 1));
            $byte2 = ord(substr($source, $i + 1, 1));
            // hack to pick out wa (and), aw (or)
            if (strlen($source) == 2) {
                if ($byte1 == 217 && $byte2 == 136) {
                    $x .= "wa";
                }
                if ($byte1 == 216 && $byte2 == 163) {
                    $x .= "aw";
                }
            }
            switch ($byte1) {
                case 216:
                    switch ($byte2) {
                        case 155:
                            $x .= ";";// arabic semicolon ?
                            break;
                        case 159:
                            $x .= "?";// ? arabic question mark
                            break;
                        case 161:
                            $x .= "a";// ? hamza
                            break;
                        case 162:
                            $x .= "AA";// ? Alif with madda
                            break;
                        case 163:
                            $x .= "a";// ? Alif with hamza
                            break;
                        case 164:
                            $x .= "ou";//? waw with hamza
                            break;
                        case 165:
                            $x .= "i";//? alif with hamza below
                            break;
                        case 166:
                            $x .= "i";// ? yeh with hamza above
                            break;
                        case 167:
                            $x .= "a";// alif?
                            break;
                        case 168:
                            $x .= "b";//  ? bah
                            break;
                        case 169:
                            $x .= "a";//  ? teh marbuta (fastened teh)
                            break;
                        case 170:
                            $x .= "t";//  ? teh
                            break;
                        case 171:
                            $x .= "th";//  ? theh
                            break;
                        case 172:
                            $x .= "j";//  ? jeem
                            break;
                        case 173:
                            $x .= "H";//  ? hah
                            break;
                        case 174:
                            $x .= "kh";// ? khah
                            break;
                        case 175:
                            $x .= "d";// ? dal
                            break;
                        case 176:
                            $x .= "Th";// ? thal
                            break;
                        case 177:
                            $x .= "r";// ? reh
                            break;
                        case 178:
                            $x .= "z";// ? zain
                            break;
                        case 179:
                            $x .= "s";// ? seen
                            break;
                        case 180:
                            $x .= "sh";// ? sheen
                            break;
                        case 181:
                            $x .= "S";// sad ?
                            break;
                        case 182:
                            $x .= "dh";// ? dad
                            break;
                        case 183:
                            $x .= "T";// ? tah
                            break;
                        case 184:
                            $x .= "TH";// ? zah
                            break;
                        case 185:
                            $x .= "A";// ? ain
                            break;
                        case 186:
                            $x .= "gh";// ? ghain
                            break;
                        case 187:
                            $x .= "gh";// ? ghain
                            break;
                    }
                    break;
                case 217:
                    switch ($byte2) {
                        case 128:
                            $x .= "";// ? tatwheel
                            break;
                        case 129:
                            $x .= "f";// ? Feh
                            break;
                        case 130:
                            $x .= "q";// ? qaf
                            break;
                        case 131:
                            $x .= "k";// ? kaf
                            break;
                        case 132:
                            $x .= "l";//  Lam ?
                            break;
                        case 133:
                            $x .= "m";// ? meem
                            break;
                        case 134:
                            $x .= "n";// ? noon
                            break;
                        case 135:
                            $x .= "h";// ? heh
                            break;
                        case 136:
                            $x .= "o";// ? waw
                            break;
                        case 137:
                            $x .= "a";// ? alef maksure
                            break;
                        case 138:
                            $x .= "i";// ? yeh
                            break;
                        // numbers
                        case 160:
                            $x .= "0";// ?
                            break;
                        case 161:
                            $x .= "1";// ?
                            break;
                        case 162:
                            $x .= "2";// ?
                            break;
                        case 163:
                            $x .= "3";// ?
                            break;
                        case 164:
                            $x .= "4";// ?
                            break;
                        case 165:
                            $x .= "5";// ?
                            break;
                        case 166:
                            $x .= "6";// ?
                            break;
                        case 167:
                            $x .= "7";// ?
                            break;
                        case 168:
                            $x .= "8";// ?
                            break;
                        case 169:
                            $x .= "9";// ?
                            break;
                    }
                    break;
                default: // if no characters match assume english and just output
                    $x .= substr($source, $i, 1);
                    // this was a single byte char so take one off the loop
                    $i = $i - 1;
                    break;
            }
            $i++;
            continue;
        }
        return $x;
    }

    public function ArToEnPhonetic($string)
    {
        $words = explode(" ", $string);
        foreach ($words as $word) {
            $this->ArabicToEnglish($word);
        }
    }

    public function EnToArPhonetic($string)
    {
        $words = explode(" ", $string);
        foreach ($words as $word) {
            $this->EnglishToArabic($word);
        }
    }




    /*
    *------------------------------------------------------------------------------------------
    * EMAIL FUNCTIONS
    *------------------------------------------------------------------------------------------
    */

    //send email
    public function send_email()
    {
        $this->load->model("email_model");
        $email_type = $this->input->post('email_type', true);
        if ($email_type == 'contact') {
            $this->send_email_contact_message();
        } elseif ($email_type == 'new_order') {
            $this->send_email_new_order();
        } elseif ($email_type == 'new_product') {
            $this->send_email_new_product();
        }elseif ($email_type == 'new_product_to_user') {
            $this->send_email_to_user();
        } elseif ($email_type == 'order_shipped') {
            $this->send_email_order_shipped();
        } elseif ($email_type == 'new_message') {
            $this->send_email_new_message();
        } elseif ($email_type == 'new_ads_message') {
            $this->send_email_new_ads_message();
        } elseif ($email_type == 'email_general') {
            $this->send_email_general();
        } elseif ($email_type == 'email_shop_request') {
            $this->send_email_shop_request();
        }
    }

    //send email contact message
    public function send_email_contact_message()
    {
        if ($this->general_settings->send_email_contact_messages == 1) {
            $data = array(
                'subject' => trans("contact_message"),
                'to' => $this->general_settings->mail_options_account,
                'template_path' => "email/email_contact_message",
                'message_name' => $this->input->post('message_name', true),
                'message_email' => $this->input->post('message_email', true),
                'message_text' => $this->input->post('message_text', true)
            );
            $this->email_model->send_email($data);
        }
    }

    //send email order summary to user
    public function send_email_new_order()
    {
        if ($this->general_settings->send_email_buyer_purchase == 1) {
            $order_id = $this->input->post('order_id', true);
            $order_id = clean_number($order_id);
            $order = get_order($order_id);
            $order_products = $this->order_model->get_order_products($order_id);
            $order_shipping = get_order_shipping($order_id);
            if (!empty($order)) {
                //send to buyer
                $to = "";
                if (!empty($order_shipping)) {
                    $to = $order_shipping->shipping_email;
                }
                if ($order->buyer_type == "registered") {
                    $user = get_user($order->buyer_id);
                    if (!empty($user)) {
                        $to = $user->email;
                    }
                }
                $data = array(
                    'subject' => trans("email_text_thank_for_order"),
                    'order' => $order,
                    'order_products' => $order_products,
                    'to' => $to,
                    'template_path' => "email/email_new_order"
                );
                $this->email_model->send_email($data);

                //send to seller
                if (!empty($order_products)) {
                    $seller_ids = array();
                    foreach ($order_products as $order_product) {
                        $seller = get_user($order_product->seller_id);
                        if (!empty($seller)) {
                            if ($seller->send_email_when_item_sold == 1 && !in_array($seller->id, $seller_ids)) {
                                array_push($seller_ids, $seller->id);
                                $seller_order_products = $this->order_model->get_seller_order_products($order_id, $seller->id);
                                $data = array(
                                    'subject' => trans("you_have_new_order"),
                                    'order' => $order,
                                    'order_products' => $seller_order_products,
                                    'to' => $seller->email,
                                    'template_path' => "email/email_new_order_seller"
                                );
                                $this->email_model->send_email($data);
                            }
                        }
                    }
                }
            }
        }
    }

    //send email new product
    public function send_email_new_product()
    {
        if ($this->general_settings->send_email_new_product == 1) {
            $this->load->model("message_model");
            $this->load->model("email_model");
            $product_id = $this->input->post('product_id', true);
            $product = $this->product_model->get_product_by_id($product_id);

            $location = "";
            if($this->general_settings->default_product_location == 0){
                $country = $this->location_model->get_country_name($product->country_id);
                $state = $this->location_model->get_state_name($product->state_id);
                if ($product->city_id){
                    $city = $this->location_model->get_city_name($product->city_id);    
                    $location = $country.'/'.$state.'/'.$city;
                }else{
                    $location = $country.'/'.$state;
                }
            }else{
                $state = $this->location_model->get_state_name($product->state_id);
                if ($product->city_id){
                    $city = $this->location_model->get_city_name($product->city_id);    
                    $location = $state.'/'.$city;
                }else{
                    $location = $state;
                }
            }

            $img_object = $this->product_model->get_image_by_id($product_id);
            $img_path = '';
            if (!(empty($img_object))) $img_path = base_url() . "uploads/images/" . $img_object->image_small;
            $sender = get_user($this->auth_user->id);
            if (!empty($product)) {
                $data = array(
                    'subject' => trans("email_text_new_product"),
                    'to' => $this->general_settings->mail_options_account,
                    'product_url' => lang_base_url() . 'product/' . $product->slug,
                    'message_subject' => $product->title,
                    'img_src' => $img_path,
                    'avatar' => base_url() . $sender->avatar,
                    'sender_name' => $sender->username,
                    'mobile_number'=> $sender->phone_number,
                    'email_address'=> $sender->email,
                    'location'=> $location,
                    'template_path' => "email/email_new_product"
                );
                $this->email_model->send_email($data);
            }
        }
    }

    //send email new message
    public function send_email_new_message()
    {
        $this->load->model("message_model");
        $this->load->model("email_model");
        $sender_id = $this->input->post('sender_id', true);
        $receiver_id = $this->input->post('receiver_id', true);
        $conversation_id = $this->input->post('conversation_id', true);
        $img_object = $this->message_model->get_image_path($conversation_id);
        $img_path = '';
        if (!(empty($img_object))) $img_path = base_url() . "uploads/images/" . $img_object->image_small;
        
        $receiver = get_user($receiver_id);
        if (!empty($receiver) && !empty($sender_id)) {
            $data = array(
                'subject' => trans("you_have_new_message"),
                'to' => $receiver->email,
                'template_path' => "email/email_new_ads_message",
                'message_sender' => "",
                'img_src' => $img_path,
                'conversation_id' => $conversation_id,
                'message_subject' => $this->input->post('message_subject', true),
                'message_text' => $this->input->post('message_text', true)
            );
            $sender = get_user($sender_id);
            if (!empty($sender)) {
                $data['message_sender'] = $sender->username;
            }
            $this->email_model->send_email($data);
        }
    }

    //send email new message
    public function send_email_to_user()
    {
        $this->load->model("message_model");
        $this->load->model("email_model");
        $product_id = $this->input->post('product_id', true);
        $product = $this->product_model->get_product_by_id($product_id);
        $img_object = $this->product_model->get_image_by_id($product_id);
        $img_path = '';
        if (!(empty($img_object))) $img_path = base_url() . "uploads/images/" . $img_object->image_small;
        $receiver = get_user($this->auth_user->id);
        if (!empty($receiver)) {
            $data = array(
                'subject' => trans("email_text_post"),
                'template_path' => "email/email_new_product_to_user",
                'to' => $receiver->email,
                'img_src' => $img_path,
                'message_subject' => $product->title,
                'product' => $product,
                'slug' => $product->slug,
            );
            $this->email_model->send_email($data);
        }
    } 
    
    //send email new ads message
    public function send_email_new_ads_message()
    {
        $this->load->model("email_model");
        $sender_id = $this->input->post('sender_id', true);
        $receiver_id = $this->input->post('receiver_id', true);
        $product = $this->product_model->get_product_by_slug($this->input->post('slug', true));
        $receiver = get_user($receiver_id);
        if (!empty($receiver) && !empty($sender_id)) {
            $data = array(
                'subject' => trans("you_have_new_message"),
                'to' => $receiver->email,
                'template_path' => "email/email_new_ads_message",
                'message_sender' => "",
                'img_src' => $this->input->post('img_src', true),
                'product'=> $product,
                'message_subject' => $this->input->post('message_subject', true),
                'message_text' => $this->input->post('message_text', true)
            );
            $sender = get_user($sender_id);
            if (!empty($sender)) {
                $data['message_sender'] = $sender->username;
            }
            $this->email_model->send_email($data);
        }
    }


    //send email order shipped
    public function send_email_order_shipped()
    {
        if ($this->general_settings->send_email_order_shipped == 1) {
            $order_product_id = $this->input->post('order_product_id', true);
            $order_product = $this->order_model->get_order_product($order_product_id);
            if (!empty($order_product)) {
                $order = get_order($order_product->order_id);
                if (!empty($order)) {
                    $to = $order->shipping_email;
                    if ($order->buyer_type == "registered") {
                        $user = get_user($order->buyer_id);
                        $to = $user->email;
                    }
                    $data = array(
                        'subject' => trans("your_order_shipped"),
                        'to' => $to,
                        'template_path' => "email/email_order_shipped",
                        'order' => $order,
                        'order_product' => $order_product
                    );
                    $this->email_model->send_email($data);
                }
            }
        }
    }

    //send email general
    public function send_email_general()
    {
        $data = array(
            'template_path' => "email/email_general",
            'to' => $this->input->post('to', true),
            'subject' => $this->input->post('subject', true),
            'email_content' => $this->input->post('email_content', true),
            'email_link' => $this->input->post('email_link', true),
            'email_button_text' => $this->input->post('email_button_text', true)
        );
        $this->email_model->send_email($data);
    }
    
    public function send_email_shop_request(){
        $this->load->model("email_model");
        $this->load->model("location_model");

        $location = "";
        if($this->general_settings->default_product_location == 0){
            $country = $this->location_model->get_country_name(user()->country_id);
            $state = $this->location_model->get_state_name(user()->state_id);
            if (user()->city_id){
                $city = $this->location_model->get_city_name(user()->city_id);    
                $location = $country.'/'.$state.'/'.$city;
            }else{
                $location = $country.'/'.$state;
            }
        }else{
            $state = $this->location_model->get_state_name(user()->state_id);
            if (user()->city_id){
                $city = $this->location_model->get_city_name(user()->city_id);    
                $location = $state.'/'.$city;
            }else{
                $location = $state;
            }
        }
        

        $data = array(
            'template_path' => "email/email_shop_request",
            'to' => $this->input->post('to', true),
            'subject' => $this->input->post('subject', true),
            'img_src' => base_url() . user()->avatar,
            'shopname' => user()->shop_name,
            'email' => user()->email,
            'phone' => user()->phone_number,
            'location' => $location,
            'email_content' => $this->input->post('email_content', true),
            'email_link' => $this->input->post('email_link', true),
            'email_button_text' => $this->input->post('email_button_text', true)
        );
        $this->email_model->send_email($data);
    }
}
