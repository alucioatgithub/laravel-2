<?php

class OpinionsController extends BaseController {

    /**
     * Stores an opinion to the survey
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function store()
    {
        $response = array();

        $validator = Validator::make(
            Input::only(['surveyid', 'responseid']), [
                'surveyid'      => [
                    'required',
                    'size:13',
                    'exists:surveys,surveyid'
                ],
                'responseid'    =>  [
                    'required',
                    'size:13'
                ]
        ]);

        // Check the survey ID
        if ($validator->fails()) {

            $response = array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            );

            return $this->failure($response);
        }

        $data = $validator->getData();


        // Get the survey
        $survey = \Survey\Survey::find($data['surveyid']);

        $status = Auth::user()
            ->surveys()
                ->answer($survey, $data['responseid']);

        $response['answered'] = $status;

        return $this->success($response);
    }
} 