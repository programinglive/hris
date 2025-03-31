<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'question',
        'answer',
        'order',
        'status',
    ];

    /**
     * Get active FAQs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function active()
    {
        return self::where('status', 'active')->orderBy('order');
    }

    /**
     * Check if the answer contains a Mermaid diagram
     *
     * @return bool
     */
    public function hasMermaidDiagram()
    {
        return str_contains($this->answer, '```mermaid');
    }

    /**
     * Extract Mermaid diagram code from the answer
     *
     * @return string|null
     */
    public function getMermaidDiagram()
    {
        if (! $this->hasMermaidDiagram()) {
            return null;
        }

        preg_match('/```mermaid\n(.+?)```/s', $this->answer, $matches);

        return $matches[1] ?? null;
    }

    /**
     * Get the answer with the Mermaid diagram code removed
     *
     * @return string
     */
    public function getAnswerWithoutMermaid()
    {
        if (! $this->hasMermaidDiagram()) {
            return $this->answer;
        }

        return preg_replace('/```mermaid\n(.+?)```/s', '', $this->answer);
    }
}
