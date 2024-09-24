<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\News;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewsForm extends Component
{
    public $companyId;

    #[Url(keep: true)]
    public $companyCode = 'all';

    #[Validate('required|unique:news|min:3')]
    public $title;

    #[Validate('required|unique:news|min:3')]
    public $content;

    public $news;

    public $actionForm = 'save';

    /**
     * Updates the specified property with the given value and performs validation if the property is 'title',
     * 'email', or 'phone'.
     *
     * @param  string  $key  The content of the property to be updated.
     * @param  mixed  $value  The new value for the property.
     *
     * @throws ValidationException
     */
    public function updated(string $key, mixed $value): void
    {
        if ($key == 'title' || $key == 'content') {
            $this->validateOnly($key);
        }
    }

    /**
     * Sets the value of the companyCode property to the given title.
     *
     * @param  string  $title  The title to set the companyCode property to.
     */
    #[On('setCompany')]
    public function setCompany(string $title): void
    {
        if ($title == '') {
            abort(404);
        }

        if ($title !== 'all') {
            $this->companyCode = $title;

            $this->companyId = Company::where('title', $title)->first()->id;
        }
    }

    /**
     * The default data for the form.
     */
    public function newsData(): array
    {
        return [
            'company_id' => $this->companyId,
            'branch_id' => 1,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    /**
     * Saves the news details to the database and dispatches a 'news-created' event.
     */
    public function save(): void
    {
        $this->validate();

        DB::transaction(function () {
            $this->news = News::create($this->newsData());
        }, 5);

        $this->dispatch('news-created', newsId: $this->news->id);

        $this->dispatch('setCompany', $this->companyCode);
        $this->dispatch('selectCompany', $this->companyId);

        $this->dispatch('enableFilter');

        $this->reset();
    }

    /**
     * Edit the news details.
     */
    #[On('edit')]
    public function edit($title): void
    {
        $this->news = News::where('title', $title)->first();
        $this->title = $this->news->title;
        $this->content = $this->news->content;

        $this->companyId = $this->news->company_id;
        $this->dispatch('selectCompany', $this->companyId);

        $this->actionForm = 'update';

        $this->dispatch('disableFilter');
        $this->dispatch('show-form');
    }

    /**
     * Updates the news details in the database.
     */
    public function update(): void
    {
        DB::transaction(function () {
            $this->news->update($this->newsData());
        }, 5);

        $this->dispatch('news-updated', newsId: $this->news->id);

        $this->dispatch('enableFilter');

        $this->reset();
    }

    /**
     * Deletes the news from the database.
     */
    #[On('delete')]
    public function destroy($title): void
    {
        $this->news = News::where('title', $title)->first();
        $this->news->title = $this->news->title.'-deleted';
        $this->news->save();

        $this->news->delete();

        $this->reset();

        $this->dispatch('news-deleted', refreshCompanies: true);
    }

    /**
     * Render the livewire component.
     */
    public function render(): View
    {
        return view('livewire.news-form');
    }
}
