<?php

namespace App\Transformers\Admin;

use App\Enums\ClubStatus;
use App\Transformers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use League\Fractal\TransformerAbstract;

class CouponTransformer extends TransformerAbstract
{



    /**
     * @param \App\CrudTransfromer $crudTransfromer
     * @return array
     */
    public function transform($model): array
    {
        return [
            'code' => $model->code,
            'discount_value' => $model->discount_value,
            'discount_type' => $model->discount_type,
            'times' => $model->times,
            'usages' => $model->usages_count,
            'status' => $this->getStatusColumn($model),
            'created_at' => $model->created_at->format('Y-m-d H:i:s'),
            'action' => $this->getActionButtons($model)
        ];
    }



    /**
     * Action Buttons
     */
    public function getActionButtons($model)
    {
        return "<div class='d-flex'><button class='btn-xs btn-success' data-toggle='modal'
            data-target='#create-edit-modal' data-code='" . $model->code . "' data-discount-value='" . $model->discount_value . "' data-discount-type='" . $model->discount_type . "'
            data-times='" . $model->times . "'  data-start-date='" . $model->start_date . "'  data-end-date='" . $model->end_date . "'
            data-form-action='" . route('admin.coupons.update', $model->id) . "" . "' data-is-create='0'><i class='fa fa-edit'></i></button> &nbsp;
                <button class='btn-xs btn-danger' data-toggle='modal' data-target='#delete-modal'
                data-delete-url='" . route('admin.coupons.destroy', $model->id) . "" . "' id='row-" . $model->id . "' data-model='" . "' data-message='" . __('general.confirm_delete') . "' data-name='" . $model->name . "'><i class='fa fa-trash'></i></button> &nbsp; </div>";
    }

    public function getStatusColumn($model)
    {
        $checked = $model->status == ClubStatus::ACTIVE->value ? 'checked' : '';
        return '<div class="custom-control custom-switch text-center">
        <input type="checkbox" class="custom-control-input" id="coupon-' . $model->id . '"  name="status"' . $checked . ' onchange="toggleStatus($(this));" value="' . $model->id . '">
            <label class="custom-control-label" for="coupon-' . $model->id . '"></label>
            </div>';
    }


}
