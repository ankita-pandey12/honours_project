<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define the fillable properties to allow mass assignment
    protected $fillable = [
        'title',        // Title of the task
        'description',  // Description of the task
        'due_date',     // Due date for the task
        'status',       // Status (like 'completed' or 'in-progress')
        'priority',     // Priority (like 'low', 'medium', 'high')
        'user_id',      // The ID of the user who owns the task
    ];

    // Automatically cast due_date to a Carbon instance
    protected $dates = ['due_date']; // This ensures due_date is treated as a Carbon instance

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Establishes the relationship with the User model
    }
}
