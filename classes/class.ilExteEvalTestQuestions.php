<?php
// Copyright (c) 2017 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Raw data for a whole test
 */
class ilExteEvalTestQuestions extends ilExteEvalTest
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
	protected $lang_prefix = 'tst_questions';


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
         // question details
        $details = new ilExteStatDetails();
        $details->columns = array (
            ilExteStatColumn::_create('question_id','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('question_title','',ilExteStatColumn::SORT_TEXT),
            ilExteStatColumn::_create('question_type','',ilExteStatColumn::SORT_TEXT),
            ilExteStatColumn::_create('question_type_label','',ilExteStatColumn::SORT_TEXT),
            ilExteStatColumn::_create('assigned_count','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('answers_count','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('maximum_points','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('average_points','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('average_percentage','',ilExteStatColumn::SORT_NUMBER)
        );
        foreach ($this->data->getAllQuestions() as $question)
        {
            $details->rows[] = array(
                'question_id' => ilExteStatValue::_create($question->question_id, ilExteStatValue::TYPE_NUMBER, 0),
                'question_title' => ilExteStatValue::_create($question->question_title, ilExteStatValue::TYPE_TEXT),
                'question_type' => ilExteStatValue::_create($question->question_type, ilExteStatValue::TYPE_TEXT),
                'question_type_label' => ilExteStatValue::_create($question->question_type_label, ilExteStatValue::TYPE_TEXT),
                'maximum_points' => ilExteStatValue::_create($question->maximum_points, ilExteStatValue::TYPE_NUMBER, 2),
                'assigned_count' => ilExteStatValue::_create($question->assigned_count, ilExteStatValue::TYPE_NUMBER, 0),
                'answers_count' => ilExteStatValue::_create($question->answers_count, ilExteStatValue::TYPE_NUMBER, 0),
                'average_points' => ilExteStatValue::_create($question->average_points, ilExteStatValue::TYPE_NUMBER, 2),
                'average_percentage' => ilExteStatValue::_create($question->average_percentage, ilExteStatValue::TYPE_NUMBER, 2),
            );
        }

        return $details;
	}
}