<?php
namespace App;

use App\Meta\Template;
use App\Code\FullStack;
use App\Code\Code;

class Aps
{

    /** @var Code $code */
    private $code;

    /**
     *
     */
    public function execute() {
        $meta = $this->code->export();
        $data = $this->metaToTemplate($meta);
        $this->templatesToSources($data);
        // file_put_contents(__DIR__ . '/../json/meta.json', json_encode($meta, JSON_PRETTY_PRINT));
        file_put_contents(__DIR__ . '/../json/template.json', json_encode($data, JSON_PRETTY_PRINT));
        file_put_contents(__DIR__ . '/../json/meta.json', json_encode($meta, JSON_PRETTY_PRINT));
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

        $this->saveTemplate(
            __DIR__ . '/templates/style.php',
            __DIR__ . '/../dist/front/src/index.css',
            [ 'style' => (array) $data->style ]
        );

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
     * @param object $meta
     * @return object
     */
    private function metaToTemplate($meta)
    {
        $template = new Template($meta);
        return $template->export();
    }

    /**
     *
     * @return FullStack
     */
    public function fullStack() {
        $this->code = new FullStack();
        return $this->code;
    }

}