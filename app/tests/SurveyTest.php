<?php


class SurveyTest extends TestCase {

    /**
     * Test for getting of one survey
     *
     * @return void
     **/
    public function testGetOneSurvey()
    {
        $survey = \Survey\Survey::take(1)->get();

        if (count($survey) == 0) {
            return;
        }

        $survey = $survey->first();

        $this->client->request(
            'GET',
            '/api/survey/' . $survey->surveyid
        );

        $response = json_decode($this->client->getResponse()->getContent());

        if (!$this->client->getResponse()->isOk()) {
            $this->assertTrue(
                isset($response->status),
                'Response has not status'
            );
            return;
        }

        $this->assertEquals(
            $response->status, BaseController::SUCCESS,
            "The status of response isn't successful"
        );

        $this->assertTrue(
            isset($response->survey),
            'There is not survey in the response'
        );
    }

    /**
     * Test for getting tags of one survey
     *
     * @return void
     **/
    public function testGetTagsOfSurvey()
    {
        $survey = \Survey\Survey::take(1)->get();

        if (count($survey) == 0) {
            return;
        }

        $survey = $survey->first();

        $this->client->request(
            'GET',
            '/api/survey/' . $survey->surveyid . '/tags'
        );

        $response = json_decode($this->client->getResponse()->getContent());

        if (!$this->client->getResponse()->isOk()) {
            $this->assertTrue(
                isset($response->status),
                'Response has not status'
            );
            return;
        }

        $this->assertEquals(
            $response->status, BaseController::SUCCESS,
            "The status of response isn't successful"
        );

        $this->assertTrue(
            isset($response->survey),
            'There is not survey in the response'
        );


        $this->assertTrue(
            isset($response->survey->tags),
            'There is not tags of survey in the response'
        );
    }
} 