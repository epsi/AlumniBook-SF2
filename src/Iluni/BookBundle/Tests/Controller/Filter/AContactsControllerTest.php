<?php

namespace Iluni\BookBundle\Tests\Controller\Filter;

use Iluni\BookBundle\Tests\ControllerTestCase;

/**
 * Simple scenario to test filter controller.
 *
 * @author E.R. Nurwijayadi <epsi.rns@gmail.com>
 */
class AContactsControllerTest extends ControllerTestCase
{
    public function testFilterScenario()
    {
        $client = $this->startScenario();

        // find entity
        $crawler = $client->request('GET', '/acontacts/');
        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertSame(200, $statusCode);

        // Prepare Data, fill in the form
        $formName = 'iluni_bookbundle_acontactsfilter';
        $formData = array(
            $formName.'[orderBy]'  => 47,
            $formName.'[community][faculty]'  => 4,
            $formName.'[contactType]'  => 4,
        );

        $url_path = '/acontacts/filter';
        $this->continueFilterScenario($url_path, $formData);

        $url_path = '/acontacts/table?page=1&orderBy=6';
        $this->continueTableScenario($url_path, 'list_edit');
    }
}

