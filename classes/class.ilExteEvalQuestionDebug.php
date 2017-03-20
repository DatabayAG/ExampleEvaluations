<?php
// Copyright (c) 2017 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

/**
 * Example evaluation for a question
 */
class ilExteEvalQuestionDebug extends ilExteEvalQuestion
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
	 * @var array   list of allowed test types, e.g. array(self::TEST_TYPE_FIXED)
	 */
	protected $allowed_test_types = array();

	/**
	 * @var array	list of question types, e.g. array('assSingleChoice', 'assMultipleChoice', ...)
	 */
	protected $allowed_question_types = array();

	/**
	 * @var string	specific prefix of language variables (lowercase classname is default)
	 */
	protected $lang_prefix = 'qst_debug';


	/**
     * Calculate the single value for a question (to be overwritten)
     * @param integer $a_question_id
     * @return ilExteStatValue
     */
	public function calculateValue($a_question_id)
	{
		return new ilExteStatValue;
	}


    /**
     * Calculate the details question (to be overwritten)
     *
     * @param integer $a_question_id
     * @return ilExteStatDetails
     */
	public function calculateDetails($a_question_id)
	{
        // answer details
        $details = new ilExteStatDetails();
        $details->columns = array (
            ilExteStatColumn::_create('question_id','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('active_id','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('pass','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('sequence','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('answered','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('reached_points','',ilExteStatColumn::SORT_NUMBER),
            ilExteStatColumn::_create('manual_scored','',ilExteStatColumn::SORT_NUMBER),
        );
        foreach ($this->data->getAnswersForQuestion($a_question_id) as $answer)
        {
            $details->rows[] = array(
                'question_id' => ilExteStatValue::_create($answer->question_id, ilExteStatValue::TYPE_NUMBER, 0),
                'active_id' => ilExteStatValue::_create($answer->active_id, ilExteStatValue::TYPE_NUMBER, 0),
                'pass' => ilExteStatValue::_create($answer->pass, ilExteStatValue::TYPE_NUMBER, 0),
                'sequence' => ilExteStatValue::_create($answer->sequence, ilExteStatValue::TYPE_NUMBER, 0),
                'answered' => ilExteStatValue::_create($answer->answered, ilExteStatValue::TYPE_BOOLEAN),
                'reached_points' => ilExteStatValue::_create($answer->reached_points, ilExteStatValue::TYPE_NUMBER, 2),
                'manual_scored' => ilExteStatValue::_create($answer->manual_scored, ilExteStatValue::TYPE_BOOLEAN),
            );
        }

        return $details;
    }

}