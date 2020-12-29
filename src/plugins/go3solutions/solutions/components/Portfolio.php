<?php namespace Go3solutions\Solutions\Components;

use Cms\Classes\ComponentBase;
use Go3solutions\Solutions\Models\Portfolio as PortfolioModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;

class Portfolio extends ComponentBase
{
    /**
     * @var PortfolioModel The portfolio model used for display.
     */
    public $portfolio;

    public function componentDetails()
    {
        return [
            'name' => 'Portfolio',
            'description' => 'Portfolio list on solutions page.'
        ];
    }

    public function onRender()
    {
        if (empty($this->portfolio)) {
            $this->portfolio = $this->page['portfolio'] = $this->loadPortfolio();
            if (empty($this->portfolio)) {
                return $this->renderPartial('site/404.htm');
            }
        }
    }

    protected function loadPortfolio()
    {
        $slug = $this->property('slug');
        $portfolio = new PortfolioModel();

        $portfolio = $portfolio->where('slug', $slug);

        try {
            $portfolio = $portfolio->firstOrFail();
            return $portfolio;
        } catch (ModelNotFoundException $ex) {
            $this->setStatusCode(404);
            $this->controller->run('404');
        }
        return null;
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title' => 'slug',
                'description' => 'slug for the portfolio.',
                'default' => '{{ :slug }}',
                'type' => 'string',
            ]
        ];
    }
}