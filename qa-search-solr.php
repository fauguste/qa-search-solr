<?php
include 'vendor/autoload.php';
/**
 *
 * @see http://www.question2answer.org/modules.php?module=search
 */
class qaSearchSolr {

  /**
   * Default option.
   * @see http://www.question2answer.org/plugins-tutorial.php (Adding options to control tag description display)
   */
  function option_default($option)
	{
		switch($option) {
      case 'plugin_search_solr_endpoint' :
        return 'http://localhost:8983/solr/q2a';
      case 'plugin_search_solr_field_id' :
          return 'id';
      case 'plugin_search_solr_field_type' :
          return 'type_s';
      case 'plugin_search_solr_field_question_id' :
          return 'question_id_i';
      case 'plugin_search_solr_field_parent_id' :
          return 'parent_id_i';
      case 'plugin_search_solr_field_title' :
          return 'title_txt';
      case 'plugin_search_solr_field_content' :
          return '';
      case 'plugin_search_solr_field_format' :
          return '';
      case 'plugin_search_solr_field_text' :
          return 'text_txt';
      case 'plugin_search_solr_field_tags' :
          return 'tags_ss';
      case 'plugin_search_solr_category_id' :
          return 'category_id_i';
      default :
        return null;
    }
	}

  /**
   * Administration form
   * @see http://www.question2answer.org/plugins-tutorial.php (Adding options to control tag description display)
   */
  function admin_form(&$qa_content)
	{
		$saved=false;

		if (qa_clicked('plugin_search_solr_save_button')) {
			qa_opt('plugin_search_solr_endpoint', (string)qa_post_text('plugin_search_solr_endpoint'));
      qa_opt('plugin_search_solr_autocommit', (bool)qa_post_text('plugin_search_solr_autocommit'));
      qa_opt('plugin_search_solr_field_id', (string)qa_post_text('plugin_search_solr_field_id'));
      qa_opt('plugin_search_solr_field_type', (string)qa_post_text('plugin_search_solr_field_type'));
      qa_opt('plugin_search_solr_field_question_id', (string)qa_post_text('plugin_search_solr_field_question_id'));
      qa_opt('plugin_search_solr_field_parent_id', (string)qa_post_text('plugin_search_solr_field_parent_id'));
      qa_opt('plugin_search_solr_field_title', (string)qa_post_text('plugin_search_solr_field_title'));
      qa_opt('plugin_search_solr_field_content', (string)qa_post_text('plugin_search_solr_field_content'));
      qa_opt('plugin_search_solr_field_format', (string)qa_post_text('plugin_search_solr_field_format'));
      qa_opt('plugin_search_solr_field_text', (string)qa_post_text('plugin_search_solr_field_text'));
      qa_opt('plugin_search_solr_field_tags', (string)qa_post_text('plugin_search_solr_field_tags'));
      qa_opt('plugin_search_solr_category_id', (string)qa_post_text('plugin_search_solr_category_id'));
      $saved=true;
		}

		return array(
			'ok' => $saved ? 'Search solr settings saved' : null,
			'fields' => array(
				array(
					'label' => 'Solr endpoint  :',
					'type' => 'text',
					'value' => (string)qa_opt('plugin_search_solr_endpoint'),
					'suffix' => '',
					'tags' => 'NAME="plugin_search_solr_endpoint"',
				),
        array(
          'label' => 'Solr autocommit',
          'type' => 'checkbox',
          'value' => (boolean)qa_opt('plugin_search_solr_autocommit'),
          'suffix' => '',
          'tags' => 'NAME="plugin_search_solr_autocommit"',
        ),
        array(
          'label' => 'Solr id field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_id'),
          'suffix' => '',
          'tags' => 'NAME="plugin_search_solr_field_id"',
        ),
        array(
          'label' => 'Solr type field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_type'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_type"',
        ),
        array(
          'label' => 'Solr question id field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_question_id'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_question_id"',
        ),
        array(
          'label' => 'Solr parent id field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_parent_id'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_parent_id"',
        ),
        array(
          'label' => 'Solr title field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_title'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_title"',
        ),
        array(
          'label' => 'Solr content field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_content'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_content"',
        ),
        array(
          'label' => 'Solr format field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_format'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_format"',
        ),
        array(
          'label' => 'Solr text field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_text'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_text"',
        ),
        array(
          'label' => 'Solr tags field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_field_tags'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_field_tags"',
        ),
        array(
          'label' => 'Solr category id field :',
          'type' => 'text',
          'value' => (string)qa_opt('plugin_search_solr_category_id'),
          'suffix' => '(not indexed if empty)',
          'tags' => 'NAME="plugin_search_solr_category_id"',
        ),
			),
			'buttons' => array(
				array(
					'label' => 'Save Changes',
					'tags' => 'NAME="plugin_search_solr_save_button"',
				),
			),
		);
	}

  /**
   * Send request to solr
   */
  function update_solr($json)
  {
    $client = new GuzzleHttp\Client();
    $url = (string)qa_opt('plugin_search_solr_endpoint')."/update";
    if((boolean)qa_opt('plugin_search_solr_autocommit')) {
      $url .= "?commit=true";
    }
    $client->post($url,
         [
         'headers' => ['Content-Type' => 'application/json'],
         'body' => json_encode($json)
        ]
    );
  }
  /**
   * @see http://www.question2answer.org/modules.php?module=search
   */
  function index_post($postid, $type, $questionid, $parentid, $title, $content, $format, $text, $tagstring, $categoryid)
  {

    $param = array();
    $param[(string)qa_opt('plugin_search_solr_field_id')] = $postid;
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_type')) != "") {
      $param[$typeField] = $type;
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_question_id')) != "") {
      $param[$typeField] = $questionid;
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_parent_id')) != "") {
      $param[$typeField] = $parentid;
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_title')) != "") {
      $param[$typeField] = $title;
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_content')) != "") {
      $param[$typeField] = $content;
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_format')) != "") {
      $param[$typeField] = $format;
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_text')) != "") {
      $param[$typeField] = $text;
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_field_tags')) != "" && $tagstring != null) {
      $param[$typeField] = explode (',', $tagstring);
    }
    if( ($typeField = (string)qa_opt('plugin_search_solr_category_id')) != "") {
      $param[$typeField] = $categoryid;
    }
    $json = array();
    $json[] = $param;

    $this->update_solr($json);


  }
  /**
   * @see http://www.question2answer.org/modules.php?module=search
   */
  function unindex_post($postid)
  {
    $json = array();
    $json['delete'] = array((string)qa_opt('plugin_search_solr_field_id') => $postid);
    $this->update_solr($json);
  }

  /**
   * @see http://www.question2answer.org/modules.php?module=search
   */
  function move_post($postid, $categoryid)
  {
    $param = array();
    $param[(string)qa_opt('plugin_search_solr_field_id')] = $postid;
    if( ($typeField = (string)qa_opt('plugin_search_solr_category_id')) != "") {
      $param[$typeField] = $categoryid;
    }
    $json = array();
    $json[] = $param;
    $this->update_solr($json);
  }
  /**
   * @see http://www.question2answer.org/modules.php?module=search
   */
  function index_page($pageid, $request, $title, $content, $format, $text)
  {
    // TODO index page
  }
  /**
   * @see http://www.question2answer.org/modules.php?module=search
   */
  function unindex_page($pageid)
  {
    // TODO unindex page
  }
  /**
   * @see http://www.question2answer.org/modules.php?module=search
   */
  function process_search($query, $start, $count, $userid, $absoluteurls, $fullcontent)
  {

    $results = array();

    $client = new GuzzleHttp\Client();
    $url = (string)qa_opt('plugin_search_solr_endpoint')."/select";

    $param  = array();
    $param['wt'] = 'json';
    $param['q'] = $query;
    $param['start'] = $start;
    $param['rows'] = $count;
    $param['defType'] = 'edismax';
    $param['qf'] = (string)qa_opt('plugin_search_solr_field_title') . '^5 ' . (string)qa_opt('plugin_search_solr_field_text'). '^3';

    $result = $client->get($url, ['query' => $param]);
    $jsonResult = json_decode($result->getBody());

    foreach($jsonResult->response->docs as $docs) {
      $result = array();
      if(array_key_exists((string)qa_opt('plugin_search_solr_field_question_id'), $docs)) {
        $result['question_postid'] = $docs->{(string)qa_opt('plugin_search_solr_field_question_id')};
      }
      if(array_key_exists((string)qa_opt('plugin_search_solr_field_type'), $docs)) {
        $result['match_type'] = $docs->{(string)qa_opt('plugin_search_solr_field_type')};
      }
      if(array_key_exists((string)qa_opt('plugin_search_solr_field_id'), $docs)) {
        $result['match_postid'] = $docs->{(string)qa_opt('plugin_search_solr_field_id')};
      }
      if(array_key_exists((string)qa_opt('plugin_search_solr_field_title'), $docs)) {
        $result['title'] = $docs->{(string)qa_opt('plugin_search_solr_field_title')}[0];
      }
      $results[] = $result;
    }
    return $results;
  }
}
