<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fonts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'code', 
        'description', 
        'file_path',
        'style',
        'user_id',
        'downloads' // زیادکردنی خانەی downloads
    ];

    protected $casts = [
        'downloads' => 'integer', // کاست کردن بۆ ئینتێجەر
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $appends = ['formatted_downloads']; // زیادکردنی ئەتریبیوتی زیادە

    /**
     * زیادکردنی ژمارەی دابەزاندن
     */
    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    /**
     * هێنانی ژمارەی دابەزاندن بە شێوازی جوان
     */
    public function getFormattedDownloadsAttribute()
    {
        $downloads = $this->downloads ?? 0;
        
        if ($downloads >= 1000000) {
            return number_format($downloads / 1000000, 1) . 'M';
        } elseif ($downloads >= 1000) {
            return number_format($downloads / 1000, 1) . 'K';
        }
        
        return $downloads;
    }

    /**
     * هێنانی ژمارەی دابەزاندن (هەرگیز ناڵێت)
     */
    public function getDownloadsAttribute($value)
    {
        return $value ?? 0;
    }

    /**
     * پەیوەندی بە بەکارهێنەرەوە
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * سکۆپ بۆ فۆنتە بەناوبانگەکان
     */
    public function scopePopular($query, $limit = 10)
    {
        return $query->orderBy('downloads', 'desc')->limit($limit);
    }

    /**
     * سکۆپ بۆ فۆنتە نوێیەکان
     */
    public function scopeNewest($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * سکۆپ بۆ گەڕان بەپێی ناو یان کۆد
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('code', 'like', "%{$term}%");
        });
    }

    /**
     * سکۆپ بۆ فلتەر بەپێی ستایل
     */
    public function scopeOfStyle($query, $style)
    {
        return $query->where('style', $style);
    }

    /**
     * سکۆپ بۆ فۆنتەکانی بەکارهێنەرێکی دیاریکراو
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}