<?php

class Api_Heist extends Omeka_Record_Api_AbstractRecordAdapter
{

    public function getRepresentation(Omeka_Record_AbstractRecord $record)
    {
        $representation = array(
            'id' => $record->id,
            'pairing_id' => $record->pairing_id,
            'device_id' => $record->device_id,
            'item_ids' => json_decode($record->item_ids, true),
            'omeka_id' => $record->omeka_id,
            'table_id' => $record->table_id,
        );
        return $representation;
    }

    public function setPostData(Omeka_Record_AbstractRecord $record, $data)
    {
        if (isset($data->pairing_id)) {
            $record->pairing_id = $data->pairing_id;
        }

        if (isset($data->device_id)) {
            $record->device_id = $data->device_id;
        }

        if (isset($data->omeka_id)) {
            $record->omeka_id = $data->omeka_id;
        }

        if (isset($data->table_id)) {
            $record->table_id = $data->table_id;
        }

        if (isset($data->item_ids)) {
            $record->item_ids = json_encode($data->item_ids);
        }
    }

    public function setPutData(Omeka_Record_AbstractRecord $record, $data)
    {
        if (isset($data->pairing_id)) {
            $record->pairing_id = $data->pairing_id;
        }

        if (isset($data->device_id)) {
            $record->device_id = $data->device_id;
        }

        if (isset($data->omeka_id)) {
            $record->omeka_id = $data->omeka_id;
        }

        if (isset($data->table_id)) {
            $record->table_id = $data->table_id;
        }

        if (isset($data->item_ids)) {
            $record->item_ids = json_encode($data->item_ids);
        }
    }
}
