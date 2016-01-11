@extends('layout.dashboard_topmenu')

@section('title','Ticket de '.$ticket->type->name.' #'.$ticket->internal_number)

@section('include_down')
    {{--Custom Select Form--}}
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2.css" id="style-resource-2">
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2-bootstrap.css" id="style-resource-3">
    <script src="/xenon/assets/js/select2/select2.min.js" id="script-resource-12"></script>
    <script>
        $(document).ready(function () {
            $("html, body").animate({scrollTop: $(document).height() - $(window).height()});

            $("#criticity").select2({
                placeholder: 'Defina una Severidad para la solicitud...',
                allowClear: true,
                dropdownAutoWidth: true
            }).on('select2-open', function () {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
            });
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="timeline-centered">
        <article class="timeline-entry begin left-aligned">
            <div class="timeline-entry-inner">
                <time class="timeline-time" datetime="{{$ticket->created_at->format('Y-m-d H:i:s T')}}">
                    <span>{{$ticket->created_at->format('d/m/Y')}}</span>
                    <span>{{$ticket->created_at->format('H:i:s T')}}</span>
                </time>
                <div class="timeline-icon timeline-bg-primary">
                    <i class="fa-ticket"></i>
                </div>
                <div class="timeline-label">
                    <h2>
                        <b>{{$ticket->internal_number}}</b>
                        <span>Ticket creado</span>
                    </h2>

                    <h3 class='criticity-{{$ticket->criticity->id}}' style="padding: 10px;">
                        Criticidad <b>{{$ticket->criticity->name}}</b>
                    </h3>
                </div>
            </div>
        </article>
        @foreach($ticket->messages as $message)
            @if($message->is_customer)
                <article class="timeline-entry left-aligned">
                    <div class="timeline-entry-inner">
                        <time class="timeline-time" datetime="{{$message->created_at->format('Y-m-d H:i:s T')}}">
                            <span>{{$message->created_at->format('d/m/Y')}}</span>
                            <span>{{$message->created_at->format('H:i:s T')}}</span>
                        </time>
                        <div class="timeline-icon timeline-bg-info">
                            <i class="fa-envelope"></i>
                        </div>
                        <div class="timeline-label">
                            <h2>
                                <b>{{$message->customer->person->fullName()}}</b>
                            </h2>
                            <blockquote>
                                {{$message->message}}
                            </blockquote>
                        </div>
                    </div>
                </article>
            @else
                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time class="timeline-time" datetime="{{$message->updated_at->format('Y-m-d\TH:i:s')}}">
                            <span>{{$message->updated_at->format('d/m/Y')}}</span>
                            <span>{{$message->updated_at->format('H:i:s T')}}</span>
                        </time>
                        <div class="timeline-icon timeline-bg-info">
                            <i class="fa-envelope"></i>
                        </div>
                        <div class="timeline-label">
                            <h2>
                                <b>{{$message->handler->person->fullName()}}</b>
                            </h2>
                            <blockquote>
                                {!! $message->message !!}
                            </blockquote>
                        </div>
                    </div>
                </article>
            @endif
        @endforeach
        <article class="timeline-entry">
            <div class="timeline-entry-inner">
                <time class="timeline-time">
                    <span>Ahora</span>
                </time>
                <div class="timeline-icon timeline-bg-info">
                    <i class="fa-paper-plane"></i>
                </div>
                <div class="timeline-label">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><b>Cambiar el ticket a:</b></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <form method="POST"
                                  action="{{route('helpdesk.ticket.changecriticity',explode('/',$ticket->internal_number))}}"
                                  role="form">
                                {!! csrf_field() !!}
                                <select name="ticket_criticity_id" id="criticity" class="form-control">
                                    <option></option>
                                    @foreach(\Models\Helpdesk\Ticket\TicketCriticity::all(['name','id']) as $criticity)
                                        <option {{$ticket->criticity->id==$criticity->id?'selected':''}} value="{{$criticity->id}}">{{$criticity->name}}</option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-info form-control" value="Cambiar severidad">
                            </form>
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-success form-control">Resuelto</div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn btn-primary form-control">Cerrado</div>
                        </div>
                    </div>
                    <hr/>

                    <h2>
                        <b>Agregar un comentario</b>
                    </h2>

                    <form method="POST"
                          action="{{route('helpdesk.ticket.addmessage',explode('/',$ticket->internal_number))}}"
                          role="form">
                        {!! csrf_field() !!}
                        <textarea
                                rows="5"
                                class="form-control"
                                id="message"
                                name="message"
                                placeholder="¿Tiene información que desee agregar al ticket?"
                                >{{old('message')}}</textarea>

                        <input type="submit" class="btn btn-info form-control" value="Enviar">
                    </form>
                </div>
            </div>
        </article>
    </div>
@endsection