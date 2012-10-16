<?php

namespace Iluni\BookBundle\Library\LD3;

use Symfony\Component\Form\FormFactoryInterface;

/**
 * District Edit Class
 */

class DistrictEditLD3 extends BaseEditLD3
{
    // Page Edit Part

    public function getJavascriptOptions($name, $entity)
    {
        $name = 'address';

        $master = $entity->getProvince();
        $detail = $entity->getDistrict();

        $result = array(
            'short_form_name'   => $name,
            'base_path_route'   => 'partial_district_edit_dummy',
            'main_path_route'   => 'partial_district_edit',
            'master_name'   => 'province',
            'detail_name'   => 'district',
            'master_index'  => $master? $master->getId(): 0,
            'detail_index'  => $detail? $detail->getId(): 0
        );

        return $result;
    }

    // Ajax Edit Part

    public function getAjaxData($master_index, $detail_index)
    {
        $defaultData['province']    = $master_index ?: 0;
        $defaultData['district']    = $detail_index ?: 0;

        return $defaultData;
    }

    public function buildForm(FormFactoryInterface $formFactory, $formName)
    {
        $builder = $formFactory->createNamedBuilder($formName, 'form');
        $builder
            ->add(
                'district',
                'partial_district_choice',
                array('master_index' => $this->master_index)
            );

        return $builder;
    }
}

