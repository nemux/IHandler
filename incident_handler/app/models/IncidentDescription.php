<?php

class IncidentDescription extends Eloquent
{

    /**
     * The database table used by the model.
     * @var string
     */
    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $table = 'incident_descriptions';
    protected $fillable = ['incidents_id', 'description', 'incident_handler_id'];

    public function incident()
    {
        return $this->belongsTo('Incident', 'incidents_id', 'id');
    }

    public function incident_handler()
    {
        return $this->belongsTo('IncidentHandler', 'incident_handler_id', 'id');
    }

    /**
     * Antes de agregar el elemento a la tabla, valida si la última descripción es igual o sufrió modificaciones.
     * Si fue modificada, se agrega un nueva nueva tupla.
     * @return mixed
     */
    public function validateBeforeSave($incidentId, $description, $incidentHandlerId)
    {
        $lastIncidentDescription = IncidentDescription::where('incidents_id', '=', $incidentId)->orderBy('id', 'desc')->first();

        if ($lastIncidentDescription === null) {
            LOG::info("Last is null");
        }

        if ($lastIncidentDescription === null || $lastIncidentDescription->description !== $description) {
            $newIncidentDescription = new IncidentDescription();
            $newIncidentDescription->incidents_id = $incidentId;
            $newIncidentDescription->description = $description;
            $newIncidentDescription->incident_handler_id = $incidentHandlerId;
            $newIncidentDescription->save();
        }
    }
}
