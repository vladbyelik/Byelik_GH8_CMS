<?php
function radix_form_system_theme_settings_alter(&$form, &$form_state) {
    // header
    $form['radix_settings']['header'] = array(
        '#type' => 'fieldset',
        '#title' => t('Header'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
    );

    $form['radix_settings']['header']['header_heading'] = array(
        '#type' => 'textfield',
        '#title' => t('Heading'),
        '#default_value' => theme_get_setting('header_heading','radix'),
    );

    $form['radix_settings']['header']['header_caption'] = array(
        '#type' => 'textfield',
        '#title' => t('Caption'),
        '#default_value' => theme_get_setting('header_caption','radix'),
    );

    // First section

    $form['radix_settings']['first_section'] = array(
        '#type' => 'fieldset',
        '#title' => t('First Section'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
    );

    $form['radix_settings']['first_section']['first_section_heading'] = array(
        '#type' => 'textfield',
        '#title' => t('Heading'),
        '#default_value' => theme_get_setting('first_section_heading','radix'),
    );

    $form['radix_settings']['first_section']['first_section_caption'] = array(
        '#type' => 'textarea',
        '#title' => t('Caption'),
        '#default_value' => theme_get_setting('first_section_caption','radix'),
    );

    //second section

    $form['radix_settings']['second_section'] = array(
        '#type' => 'fieldset',
        '#title' => t('Second Section'),
        '#collapsible' => TRUE,
        '#collapsed' => TRUE,
    );

    $form['radix_settings']['second_section']['second_section_heading'] = array(
        '#type' => 'textfield',
        '#title' => t('Heading'),
        '#default_value' => theme_get_setting('second_section_heading','radix'),
    );

}

//    $form['radix_settings']['second_section'] = array(
//        '#type' => 'fieldset',
//        '#title' => t('Second section'),
//        '#collapsible' => TRUE,
//        '#collapsed' => TRUE,
//    );
//
//    $second_section_block_count = theme_get_setting('second_section_block_count');
//
//    $form['radix_settings']['second_section']['second_section_block_count'] = array(
//        '#type' => 'select',
//        '#title' => t('Number of blocks'),
//        '#options' => range(1, 4),
//        '#default_value' => $second_section_block_count,
//    );
//
//
//    // Range indexes start's with 0, hence the slide_count+1 in the for
//    // condition.
//    for ($index = 1; $index <= $second_section_block_count + 1; $index++) {
//        $form['radix_settings']['second_section']['second_section_' . $index] = array(
//            '#type' => 'fieldset',
//            '#title' => t('Block ') . ' ' . $index,
//            '#collapsible' => TRUE,
//            '#collapsed' => TRUE,
//        );
//    }


    //


