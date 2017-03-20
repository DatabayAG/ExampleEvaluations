<?php
// Copyright (c) 2017 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Raw data for a whole test
 */
class ilExteEvalTestParticipants extends ilExteEvalTest
{
	/**
	 * @var bool	evaluation provides a single value for the overview level
	 */
	protected $provides_value = false;

	/**
	 * @var bool	evaluation provides data for a details screen
	 */
	protected $provides_details = true;

	/**
	 * @var array list of allowed test types, e.g. array(self::TEST_TYPE_FIXED)
	 */
	protected $allowed_test_types = array();

	/**
	 * @var array	list of question types, e.g. array('assSingleChoice', 'assMultipleChoice', ...)
	 */
	protected $allowed_question_types = array();

	/**
	 * @var string	specific prefix of language variables (lowercase classname is default)
	 */
	protected 	$lang_prefix = 'tst_participants';


	/**
	 * Calculate and get the single value for a test
	 *
	 * @return ilExteStatValue
	 */
	public function calculateValue()
	{
        return new ilExteStatValue;
	}


	/**
	 * Calculate the details for a test
	 *
	 * @return ilExteStatDetails
	 */
	public function calculateDetails()
	{
        // participant details
        $details = new ilExteStatDetails();
        $details->columns = array (
            ilExteStatColumn::_create('active_id','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('last_pass','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('best_pass','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('scored_pass','',ilExteStatColumn::SORT_NUMBER),
			ilExteStatColumn::_create('reached_points','',ilExteStatColumn::SORT_NUMBER)
		);
        foreach ($this->data->getAllParticipants() as $participant)
        {
            $details->rows[] = array(
                'active_id' => ilExteStatValue::_create($participant->active_id, ilExteStatValue::TYPE_NUMBER, 0),
                'last_pass' => ilExteStatValue::_create($participant->last_pass, ilExteStatValue::TYPE_NUMBER, 0),
                'best_pass' => ilExteStatValue::_create($participant->best_pass, ilExteStatValue::TYPE_NUMBER, 0),
                'scored_pass' => ilExteStatValue::_create($participant->scored_pass, ilExteStatValue::TYPE_NUMBER, 0),
				'reached_points' => ilExteStatValue::_create($participant->current_reached_points, ilExteStatValue::TYPE_NUMBER, 2)
			);
        }

        return $details;
	}
}