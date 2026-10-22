<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['dance_class_id', 'day_of_week', 'start_time', 'end_time', 'room', 'capacity'];

    public function danceClass(): BelongsTo
    {
        return $this->belongsTo(DanceClass::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /** Number of seats currently taken (cancelled enrollments free the seat). */
    public function getSeatsTakenAttribute(): int
    {
        return $this->enrollments()->where('status', '!=', 'Cancelled')->count();
    }

    public function getTimeRangeAttribute(): string
    {
        return Carbon::parse($this->start_time)->format('g:i A') . ' - ' . Carbon::parse($this->end_time)->format('g:i A');
    }

    public function getLabelAttribute(): string
    {
        return $this->danceClass->name . ' | ' . $this->day_of_week . ' ' . $this->time_range . ' | ' . $this->room;
    }
}
