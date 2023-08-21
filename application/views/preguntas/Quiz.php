<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('quiz_m');
  }

  public function index()
  {
    $data['count_questions'] = $this->quiz_m->get_count_questions();
    $data['subview'] = 'index';
    $this->load->view('_quiz_layout', $data);
  }

  public function question($question_id)
  {
    $data['count_questions'] = $this->quiz_m->get_count_questions();
    $data['question'] = $this->quiz_m->get_question($question_id);
    $data['choices'] = $this->quiz_m->get_choices($question_id);
    $data['subview'] = 'question';
    $this->load->view('_quiz_layout', $data);
  }

  public function process()
  {
    if (!$this->session->userdata('score')) {
      $this->session->userdata('score', 0);
    }

    $question_id = $this->input->post('question_id');
    $selected_choice = $this->input->post('choice_text');
    $next_question = $question_id + 1;

    $row = $this->quiz_m->get_correct_choice($question_id);
    $correct_choice = $row->id;

    if ($selected_choice == $correct_choice) {
      $this->session->score++;
    }

    $total = $this->quiz_m->get_count_questions();

    if ($question_id == $total) {
      redirect('quiz/final');
    }else{
      redirect('quiz/question/'.$next_question);
    }
  }

  public function final()
  {
    $this->session->sess_destroy();
    $data['subview'] = 'final';
    $this->load->view('_quiz_layout', $data);
  }

  public function add()
  {
    $rules = $this->quiz_m->rules;
    $this->form_validation->set_rules($rules);

    if ($this->form_validation->run() == TRUE) {
      $question_data = $this->quiz_m->array_from_post(['question_id', 'question_text']);

      if ($this->quiz_m->save_question($question_data)) {

        foreach ($this->input->post('choices') as $key => $value) {

          if ($this->input->post('is_correct') == $key + 1)
            $is_correct = 1;
          else
            $is_correct = 0;

          $choices_data = ['question_id' => $this->input->post('question_id'),
                            'is_correct' => $is_correct,
                            'choice_text' => $value
                          ];

          if ($this->quiz_m->save_choices($choices_data))
            continue;
        }

        $this->session->set_flashdata('msg', 'Pregunta insertada correctamente');
        redirect('quiz/add', 'refresh');
      }
    }

    $data['count_questions'] = $this->quiz_m->get_count_questions();
    $data['subview'] = 'add';
    $this->load->view('_quiz_layout', $data);
  }

}

/* End of file Quiz.php */
/* Location: ./application/controllers/Quiz.php */