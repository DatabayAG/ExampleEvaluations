Example Evaluations for the ILIAS ExtendedTestStatistics Plugin
===============================================================

Copyright (c) 2017 Institut fuer Lern-Innovation, Friedrich-Alexander-Universitaet Erlangen-Nuernberg, GPLv3, see LICENSE

**Further maintenance can be offered by [Databay AG](https://www.databay.de).**

Requirements
------------

This is an add-on to the ExtendedTestStatistics for ILIAS. You need to install that plugin to use the example evaluations:
https://github.com/DatabayAG/ExtendedTestStatistics

Installation
------------

When you download the add-on as ZIP file from GitHub, please rename the extracted directory to *ExampleEvaluations*
(remove the branch suffix, e.g. -master).

Copy the ExampleEvaluations directory to your ILIAS installation at the followin path
(create subdirectories, if neccessary): 

`Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/ExtendedTestStatistics/addons`

The example evaluations are automatically recognized by the ExtendedTestStatistics plugin and shown in its plugin
administration. Choose here if they should be available to platform administrators or all users.

Purpose
-------

The main purpose of the example evaluations is to demonstrate how additional evaluations can be hooked into the 
ExtendedTestStatistics plugin and how a future plugin slot of ILIAS for test and question statistics may look like.

They don't calculate anything but provide the raw data on which other evaluations may be calculated. Three example evaluations 
are available: 

* *ilExteEvalTestParticipants* provides a details table for test participants: active id, number of last, best and scored pass
  and the reached points of the best pass.
* *ilExteEvalTestQuestions* provides a details table of the questions in the selected test pass: id, title, type, 
  number of participant assignments, number of saved answers, maximum and average points and the resulting average percentage
* *ilExteEvalQuestionDebug* provides the raw, question type independent result data of questions in the selected test pass:
  question id, active id, pass number, sequence number, answered status, reached points and manual scoring indicator.

  
Implementation of an Evaluation
===============================

You may also look at the builtin evaluations of the ExtendedTestStatistics plugin to get further examples of how an 
evaluation is implemented. 

Directory Structure
-------------------

The directory name of an add-on may be any valid directory name. It must contain two sub directories:
 
* *classes* provides all evaluation classes of the plugins. The class names must follow the class name rules of ILIAS 
  and must be unique.
* *lang* contains the language files of the evaluations, e.g. ilias_de.lang or ilias_en.lang.

Each evaluation is either a sub class ilExteEvalTest or ilExteEvalQuestion. These abstract parent classes are already 
included as well as other model classes listed below. 

Source Data
-----------

* *ilExteStatParam* is the data structure for a configuration parameter of the evaluation.
* *ilExteStatSourceData*  provides the basic test and question values.
* *ilExteStatSourceParticipant* is the raw data structure for a participant (see ilExteEvalTestParticipants for usage).
* *ilExteStatSourceQuestion* is the raw data structure for a question (see ilExteEvalTestQuestions for usage).
* *ilExteStatSourceAnswer* is the the raw data structure for a question presented to a participant, whether answered or not
  (see ilExteEvalQuestionDebug for details).

Result Data
-----------

* *ilExteStatValue* is the data structure for a scalar evaluation value with optional comment and alert sign.
* *ilExteStatDetails* is the data structure for a table of detailed results. It is composed of column definitions and rows with values.
* *ilExteStatColumns* is the data structure for a column definition of a details table.

Class Variables of an evaluation (to be overridden)
--------------------------------------------------

* *provides_value* (bool) indicates whether the evaluation provides a scalar value as result.
* *provides_details* (bool) indicates whether the evaluation provides a details table as result.
* *allowed_test_types* (array) is a list of test types for which the evaluation can be calculated.
* *allowed_question_types* (array) is a list of question types for which the evaluation can be calculated.
* *lang_prefix* (string) is the prefix of the evaluation in the language file of the add-on.

Methods of an evaluation (to be overridden)
-------------------------------------------

* *getAvailableParams()* provides a list of parameter definitions of type *ilExteStatParam*. The values of these definitions 
  are the default parameter values. The actual values are set in the configuration of the ExtendedTestStatistics plugin.
* *calculateValue()* calculates the single value of the evaluation. Question evaluations get the question id as parameter.
* *calculateDetails()* calculates the details table of an evaluation. Question evaluations get the question id as parameter.

Useful Properties and Methods of All Evaluation Classes
-------------------------------------------------------

* The *data* property is automatically initialized with the source data for all evaluations (ilExteStatSourceData)
* The *txt()* function provides a localized text for the evaluation. The parameter is prefixes with the lang_prefix, e.g. 
  if *lang_prefix* is 'eval1' then *$this->txt('message1')* will get the values of the 'eval1_message1' language variable.
* The *getParam()* function gets the actual configuration value of the parameter with the given name. 

Standard Language Variables of an Evaluation
--------------------------------------------

Assumed that 'eval1' is the *lang_prefix* of an evaluation, then the following language variables are automatically used:

* *eval1_title_long* is used as title of the evaluation, e.g. in the plugin configuration
* *eval1_title_short* is used for the column header in a table 
* *eval1_description* is displayed as tooltip of the title
* *eval1_param1_title* is the label of the evaluation parameter 'param1' in the plugin configuration
* *eval1_param1_description* is the info text of the evaluation parameter 'param1' in the plugin configuration


