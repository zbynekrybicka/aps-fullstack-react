<?php
namespace App;

use App\Meta\Template;

class Aps
{

    /** @var Template $template */
    private $template;

    /**
     *
     */
    public function execute() {
        $data = $this->template->export();
        file_put_contents(__DIR__ . '/../template.json', json_encode($data, JSON_PRETTY_PRINT));
        $this->templatesToSources($data);
    }


    /**
     *
     * @param object $data
     */
    private function templatesToSources($data)
    {
        foreach ($data->components as $component) {
            $this->saveTemplate(
                __DIR__ . '/templates/component.php',
                __DIR__ . '/../dist/front/src/components/' . $component->title . '.js',
                (array) $component);
        }
        
        $this->saveTemplate(
            __DIR__ . '/templates/store.php', 
            __DIR__ . '/../dist/front/src/store/index.js', 
            [ 'reducers' => $data->reducers ]
        );
        
        $this->saveTemplate(
            __DIR__ . '/templates/state.php', 
            __DIR__ . '/../dist/front/src/store/state.js', 
            [ 'state' => $data->state ]
        );

        foreach ($data->actions as $action) {
            $this->saveTemplate(
                __DIR__ . '/templates/action.php',
                __DIR__ . '/../dist/front/src/actions/' . $action->title . '.js',
                (array) $action);
        }

        $this->saveTemplate(
            __DIR__ . '/templates/route.php', 
            __DIR__ . '/../dist/api/app/route.php', 
            [ 'routes' => $data->routes ]
        );
        
        foreach ($data->services as $service) {
            $this->saveTemplate(
                __DIR__ . '/templates/service.php',
                __DIR__ . '/../dist/api/app/Service/' . ucfirst($service->title) . 'Service.php',
                (array) $service);
        }

    }


    /**
     *
     * @param string $template
     * @param string $filename
     * @param array $data
     */
    private function saveTemplate($template, $filename, $data) {
        ob_start();
        extract($data);
        include $template;
        $output = ob_get_clean();
        file_put_contents($filename, $output);
    }

    /**
     *
     * @return Template
     */
    public function template() {
        $this->template = new Template();
        return $this->template;
    }

}