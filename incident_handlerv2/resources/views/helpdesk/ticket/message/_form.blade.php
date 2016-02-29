<form method="POST" role="form" enctype="multipart/form-data"
      action="{{route('helpdesk.ticket.addmessage',explode('/',$ticket->internal_number))}}">
    {!! csrf_field() !!}
    <div class="form-group">
        <textarea rows="5"
                  class="form-control"
                  id="message"
                  name="message"
                  placeholder="¿Tiene información que desee agregar al ticket?"
                >{{old('message')}}</textarea>
    </div>
    <div class="form-group">
        <input type="file" name="evidence" id="evidence">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-info form-control" value="Enviar">
    </div>
</form>