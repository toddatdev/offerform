<?php

if (!function_exists('offer_form_steps_input_value')) {
    function offer_form_steps_input_value($form, $section, $name, $default = '')
    {
        $formData = Cookie::get($form);

        if ($formData) {
            try {
                $formData = json_decode($formData, true);

                if (isset($formData[$section][$name])) {
                    return $formData[$section][$name];
                }
            } catch (\Exception $e) {
                Log::error('offer_form_steps_input_value', $e->getTrace());
                Log::info('offer_form_steps_input_value', [$formData]);
            }

        }

        return $default;
    }
}

if (!function_exists('section_user_response')) {
    function section_user_response($section, $submitted = false, $plain = false)
    {
        $name = str_replace('-', '_', strtolower($section->type_config['type']));
        $val = $section->user_response[$name] ?? '';
        $options = $section->type_config['options'] ?? [];

        if ($section instanceof \App\Models\OfferForms\OfferFormSection) {
            $section = $section->submittedSection;
            if ($section) {
                $val = $section->user_response[$name] ?? '';
            }
        }

        switch ($name) {
            case 'yes_or_no':
            case 'lead_activation':
                $val = $val ? 'Yes' : 'No';
                break;
            case 'checkboxes':

                $selectedOptions = explode(',', trim($val, ','));
                $val = [];
                foreach ($options as $key => $option) {
                    if (in_array($key, $selectedOptions)) {
                        $val[] = $option['text'];
                    }
                }
                $val = implode(', ', $val);
                break;
            case 'multiple_choice':
            case 'dropdown':
                $val = is_array($options) && isset($options[$val]) ? $options[$val]['text'] ?? '' : '';
                break;
            case 'dollar_amount':
                $val = '$' . number_format(sanitize_number_int($val));
                break;
            case 'mortgage_calculator':
            case 'seller_financing_calculator':
                //                try {
                //                    $data = unserialize(stripslashes($val));
                //                    $response = "Offer Amount: $" . ($data['offerAmount'] ?? 0) . ", ";
                //                    $response .= "Down Payment: $" . ($data['down_payment'] ?? 0);
                //                    $val = $response ;
                //                } catch (\Exception $e) {
                //                    \Log::error($e->getTrace());
                //                }
                break;
            case 'file_upload':
                $files = is_array($val) ? $val : [];
                $showableFileLinks = [];
                foreach ($files as $file) {
                    $link = asset("storage/{$file['download_link']}");
                    if ($plain) {
                        $showableFileLinks[] = $link;
                        $val = implode(',', $showableFileLinks);
                    } else {
                        $showableFileLinks[] = <<<EOF
                        <a href="$link" class="text-white" target="_blank" class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-paperclip"
                                 viewBox="0 0 16 16">
                                <path
                                    d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
                            </svg>
                            {$file['original_name']}
                        </a>
EOF;
                        $val = implode('<span class="mx-2">|</span>', $showableFileLinks);
                    }
                }


                break;
            case 'logic':
                if ($val === '-1' || $val === -1) {
                    $val = '-';
                }
                break;
            case 'time':
                $val = date("g:i a", strtotime("$val UTC"));
                break;
            case 'e_signature':

                $signedAt ='';
                if (isset($section->user_response['signed_at'])) {
                    try {
                        $signedAt = \Carbon\Carbon::parse($section->user_response['signed_at'])->timezone(session('ip_position:timezone', 'UTC'))->format('m/d/y g:i A');
                    } catch (Exception $e) {
                        \Illuminate\Support\Facades\Log::error('E-Signature Signed At: ', [$e->getMessage()]);
                    }
                }

                if (str_starts_with($val, 'signatures/')) {


                    $link = Storage::disk('public')->url($val);
                    if ($plain) {
                        $val = $link;
                    } else {
                        $val = <<<Eof
                            <a href="$link" class="text-white" target="_blank" class="text-decoration-none" title="Click to View Signature">
                                 <img src="$link" width="115px" style="margin: -12px" alt=""/> <span>($signedAt)</span>
                            </a>
Eof;
                    }

//                    $val = <<<EOF
//                        <a href="" class="text-white" target="_blank" class="text-primary">
//                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
//                                 class="bi bi-paperclip"
//                                 viewBox="0 0 16 16">
//                                <path
//                                    d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
//                            </svg>
//                            Click to View Signature
//                        </a>
//EOF;
                }else{
                    if ($plain) {
                        $val = "$val ($signedAt)";
                    } else {
                        $val = <<<EOF
                            <span class="quintessential-font letter-space1" style="letter-spacing: 1px">$val</span> ($signedAt)
EOF;
                    }
                }

                break;
        }
        return $val;

    }
}
