@extends('layout')

@section('content')
  <div class="card">
      <div class="card-content">
      <span class="card-title"> Start taking Survey</span>
      <p>
        <span class="flow-text">{{ $survey->title }}</span> <br/>
      </p>
      <p>  
        {{ $survey->description }}
        <br/>Created by: <a href="">{{ $survey->user->name }}</a>
      </p>
      <div class="divider" style="margin:20px 0px;"></div>
          {!! Form::open(array('action'=>array('AnswerController@store', $survey->id))) !!}
          @forelse ($survey->questions as $key=>$question)
            <p class="flow-text">Question {{ $key+1 }} - {{ $question->title }}</p>
                @if($question->question_type === 'text')
                  <div class="input-field col s12">
                    <input id="answer" type="text" name="{{ $question->id }}[answer]">
                    <label for="answer">Answer</label>
                  </div>
                  @elseif($question->question_type === 'number')
                  <div class="input-field col s12">
                    <input id="answer" type="number" name="{{ $question->id }}[answer]">
                    <label for="answer">Answer</label>
                  </div>
                  @elseif($question->question_type === 'range')
                  <div class="input-field col s12">
                    <input id="answer" type="range" name="{{ $question->id }}[answer]" min="0" max="50">
                    <label for="answer">Answer</label>
                  </div>
                @elseif($question->question_type === 'textarea')
                  <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea" name="{{ $question->id }}[answer]"></textarea>
                    <label for="textarea1">Textarea</label>
                  </div>
                  
                @elseif($question->question_type === 'radio')
                  @foreach($question->option_name as $key=>$value)
                    <p style="margin:0px; padding:0px;">
                      <input name="{{ $question->id }}[answer]" type="radio" id="{{ $key }}" />
                      <label for="{{ $key }}">{{ $value }}</label>
                    </p>
                  @endforeach
                @elseif($question->question_type === 'checkbox')
                  @foreach($question->option_name as $key=>$value)
                  <p style="margin:0px; padding:0px;">
                    <input type="checkbox" id="something{{ $key }}" name="{{ $question->id }}[answer]" />
                    <label for="something{{$key}}">{{ $value }}</label>
                  </p>
                  @endforeach
                @endif 
              <div class="divider" style="margin:10px 10px;"></div>
          @empty
            <span class='flow-text center-align'>Nothing to show</span>
          @endforelse
        {{ Form::submit('Submit Survey', array('class'=>'btn waves-effect waves-light')) }}
        {!! Form::close() !!}
    </div>
  </div>
@stop