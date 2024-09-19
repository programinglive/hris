<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class NewsTable extends Component
{
    use withPagination;

    public $showForm = false;

    public $companyId;

    #[Url(keep: true)]
    public $companyCode = 'all';

    #[Url]
    public $search;

    /**
     * Initializes the component by setting the company ID based on the provided code.
     */
    public function mount(): void
    {
        if ($this->companyCode != 'all') {
            $this->companyId = Company::where('code', $this->companyCode)->first()->id;
        }
    }

    /**
     * Sets the company ID based on the provided code.
     *
     * @param  string  $code  The code of the company.
     */
    #[On('setCompany')]
    public function setCompany(string $code): void
    {
        if ($code == '') {
            abort(404);
        }
        if ($code != 'all') {
            $this->companyCode = $code;
            $this->companyId = Company::where('code', $code)->first()->id;
        } else {
            $this->companyCode = 'all';
        }

        $this->resetPage();
    }

    /**
     * Handles the event when a news is created.
     *
     * @param  int  $newsId  The ID of the created news.
     */
    #[On('news-created')]
    public function newsAdded(int $newsId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a news is updated.
     *
     * @param  int  $newsId  The ID of the updated news.
     */
    #[On('news-updated')]
    public function newsUpdated(int $newsId): void
    {
        $this->showForm = false;
    }

    /**
     * Handles the event when a news is deleted.
     */
    #[On('news-deleted')]
    public function newsDeleted(): void
    {
        $this->showForm = false;

        $this->resetPage();
        $this->getDepartments();
    }

    /**
     * Shows the form news.
     */
    #[On('show-form')]
    public function showForm(): void
    {
        $this->showForm = true;
    }

    /**
     * Retrieves a paginated list of newss based on a search query.
     *
     * @return LengthAwarePaginator The paginated list of newss.
     */
    #[On('getDepartments')]
    public function getNews(): LengthAwarePaginator
    {
        $news = News::where(function ($query) {
            $query->where('code', 'like', '%'.$this->search.'%')
                ->orWhere('name', 'like', '%'.$this->search.'%');
        })->orderBy('id');

        if ($this->companyCode == '') {
            abort(404);
        }

        if ($this->companyCode != 'all') {
            $news = $news->where('company_id', $this->companyId);
        }

        return $news->paginate(5);
    }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.news-table', [
            'newsData' => self::getNews(),
        ]);
    }
}
