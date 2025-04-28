<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* event/showclient.html.twig */
class __TwigTemplate_5ae98583581e116b97a1aa3d5a6a0493 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "homepage.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/showclient.html.twig"));

        $this->parent = $this->loadTemplate("homepage.html.twig", "event/showclient.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Evennement";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<style>
.background-container {
    position: relative;
    margin-top: 85px;
    margin-bottom: 30px;
    padding: 30px;
    z-index: 1;
}

.background-container::before {
    content: \"\";
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url('";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 20, $this->source); })()), "categorieEvent", [], "any", false, false, false, 20), "image", [], "any", false, false, false, 20))), "html", null, true);
        yield "');
    background-size: cover;
    background-position: center;
    opacity: 0.4; 
    z-index: -1; 
    border-radius: 15px;
}
.content-overlay {
    background-color: rgba(255, 255, 255, 0.8); /* blanc semi-transparent */
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
</style>

";
        // line 35
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 35, $this->source); })()), "categorieEvent", [], "any", false, false, false, 35) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 35, $this->source); })()), "categorieEvent", [], "any", false, false, false, 35), "image", [], "any", false, false, false, 35))) {
            // line 36
            yield "<div class=\"background-container\">
";
        } else {
            // line 38
            yield "<div style=\"margin-top: 90px;\"> ";
        }
        // line 40
        yield "
    <div style=\"display: flex; justify-content: space-between; align-items: flex-start; gap: 30px;\">
        
        <div class=\"content-overlay\" style=\"flex: 1;\">
            <h1>Evennement :</h1>
            <table class=\"table table-striped\">
                <tbody>
                    <tr>
                        <th>Nom de l'événement</th>
                        <td>";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 49, $this->source); })()), "nomEvent", [], "any", false, false, false, 49), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>Date de l'événement</th>
                        <td>";
        // line 53
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 53, $this->source); })()), "dateEvent", [], "any", false, false, false, 53)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 53, $this->source); })()), "dateEvent", [], "any", false, false, false, 53), "Y-m-d"), "html", null, true)) : (""));
        yield "</td>
                    </tr>
                    <tr>
                        <th>Adresse de l'événement</th>
                        <td>";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 57, $this->source); })()), "adresseEvent", [], "any", false, false, false, 57), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>La ville</th>
                        <td>";
        // line 61
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 61, $this->source); })()), "villes", [], "any", false, false, false, 61), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 65, $this->source); })()), "descriptionEvent", [], "any", false, false, false, 65), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>État de l'événement</th>
                        <td>";
        // line 69
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 69, $this->source); })()), "statusEvent", [], "any", false, false, false, 69), ["_" => " "])), "html", null, true);
        yield "</td>
                    </tr>
                    <tr>
                        <th>Nombre de participants maximal</th>
                        <td>";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 73, $this->source); })()), "nbParticipantMax", [], "any", false, false, false, 73), "html", null, true);
        yield "</td>
                    </tr>
                </tbody>
            </table>

            <div class=\"d-flex gap-2 mt-3\">
                <a href=\"";
        // line 79
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_public");
        yield "\" class=\"btn btn-secondary\">
                    <i class=\"fas fa-arrow-left me-1\"></i> Revenir à la liste
                </a>
            </div>
        </div>

        <!-- Partie droite : Météo -->
        ";
        // line 86
        if (array_key_exists("currentTemp", $context)) {
            // line 87
            yield "            <div style=\"background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); min-width: 250px; text-align: right;\">
                <p><strong>Température :</strong> ";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["currentTemp"]) || array_key_exists("currentTemp", $context) ? $context["currentTemp"] : (function () { throw new RuntimeError('Variable "currentTemp" does not exist.', 88, $this->source); })()), "html", null, true);
            yield " °C</p>
                <p><strong>Humidité :</strong> ";
            // line 89
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["currentHumidity"]) || array_key_exists("currentHumidity", $context) ? $context["currentHumidity"] : (function () { throw new RuntimeError('Variable "currentHumidity" does not exist.', 89, $this->source); })()), "html", null, true);
            yield " %</p>
                <p><strong>Vent :</strong> ";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["currentWind"]) || array_key_exists("currentWind", $context) ? $context["currentWind"] : (function () { throw new RuntimeError('Variable "currentWind" does not exist.', 90, $this->source); })()), "html", null, true);
            yield " km/h</p>

                ";
            // line 92
            $context["canGoOut"] = (((((isset($context["currentTemp"]) || array_key_exists("currentTemp", $context) ? $context["currentTemp"] : (function () { throw new RuntimeError('Variable "currentTemp" does not exist.', 92, $this->source); })()) >= 18) && ((isset($context["currentTemp"]) || array_key_exists("currentTemp", $context) ? $context["currentTemp"] : (function () { throw new RuntimeError('Variable "currentTemp" does not exist.', 92, $this->source); })()) <= 28)) && ((            // line 93
(isset($context["currentHumidity"]) || array_key_exists("currentHumidity", $context) ? $context["currentHumidity"] : (function () { throw new RuntimeError('Variable "currentHumidity" does not exist.', 93, $this->source); })()) >= 30) && ((isset($context["currentHumidity"]) || array_key_exists("currentHumidity", $context) ? $context["currentHumidity"] : (function () { throw new RuntimeError('Variable "currentHumidity" does not exist.', 93, $this->source); })()) <= 70))) && (            // line 94
(isset($context["currentWind"]) || array_key_exists("currentWind", $context) ? $context["currentWind"] : (function () { throw new RuntimeError('Variable "currentWind" does not exist.', 94, $this->source); })()) <= 30));
            // line 95
            yield "                ";
            if ((isset($context["canGoOut"]) || array_key_exists("canGoOut", $context) ? $context["canGoOut"] : (function () { throw new RuntimeError('Variable "canGoOut" does not exist.', 95, $this->source); })())) {
                // line 96
                yield "                    <p style=\"color: green; font-weight: bold;\">✅ Bon temps pour sortir !</p>
                ";
            } else {
                // line 98
                yield "                    <p style=\"color: red; font-weight: bold;\">❌ Pas conseillé de sortir !</p>
                ";
            }
            // line 100
            yield "            </div>
        ";
        } else {
            // line 102
            yield "            <div style=\"text-align: right; min-width: 250px;\">
                <p>Aucune donnée météo disponible.</p>
            </div>
        ";
        }
        // line 106
        yield "    </div>

</div> ";
        // line 109
        yield "
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "event/showclient.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  247 => 109,  243 => 106,  237 => 102,  233 => 100,  229 => 98,  225 => 96,  222 => 95,  220 => 94,  219 => 93,  218 => 92,  213 => 90,  209 => 89,  205 => 88,  202 => 87,  200 => 86,  190 => 79,  181 => 73,  174 => 69,  167 => 65,  160 => 61,  153 => 57,  146 => 53,  139 => 49,  128 => 40,  125 => 38,  121 => 36,  119 => 35,  101 => 20,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'homepage.html.twig' %}

{% block title %}Evennement{% endblock %}

{% block body %}
<style>
.background-container {
    position: relative;
    margin-top: 85px;
    margin-bottom: 30px;
    padding: 30px;
    z-index: 1;
}

.background-container::before {
    content: \"\";
    position: absolute;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset('uploads/' ~ event.categorieEvent.image) }}');
    background-size: cover;
    background-position: center;
    opacity: 0.4; 
    z-index: -1; 
    border-radius: 15px;
}
.content-overlay {
    background-color: rgba(255, 255, 255, 0.8); /* blanc semi-transparent */
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
</style>

{% if event.categorieEvent and event.categorieEvent.image %}
<div class=\"background-container\">
{% else %}
<div style=\"margin-top: 90px;\"> {# fallback si jamais pas d'image #}
{% endif %}

    <div style=\"display: flex; justify-content: space-between; align-items: flex-start; gap: 30px;\">
        
        <div class=\"content-overlay\" style=\"flex: 1;\">
            <h1>Evennement :</h1>
            <table class=\"table table-striped\">
                <tbody>
                    <tr>
                        <th>Nom de l'événement</th>
                        <td>{{ event.nomEvent }}</td>
                    </tr>
                    <tr>
                        <th>Date de l'événement</th>
                        <td>{{ event.dateEvent ? event.dateEvent|date('Y-m-d') : '' }}</td>
                    </tr>
                    <tr>
                        <th>Adresse de l'événement</th>
                        <td>{{ event.adresseEvent }}</td>
                    </tr>
                    <tr>
                        <th>La ville</th>
                        <td>{{ event.villes }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ event.descriptionEvent }}</td>
                    </tr>
                    <tr>
                        <th>État de l'événement</th>
                        <td>{{ event.statusEvent|replace({'_': ' '})|capitalize }}</td>
                    </tr>
                    <tr>
                        <th>Nombre de participants maximal</th>
                        <td>{{ event.nbParticipantMax }}</td>
                    </tr>
                </tbody>
            </table>

            <div class=\"d-flex gap-2 mt-3\">
                <a href=\"{{ path('app_event_public') }}\" class=\"btn btn-secondary\">
                    <i class=\"fas fa-arrow-left me-1\"></i> Revenir à la liste
                </a>
            </div>
        </div>

        <!-- Partie droite : Météo -->
        {% if currentTemp is defined %}
            <div style=\"background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); min-width: 250px; text-align: right;\">
                <p><strong>Température :</strong> {{ currentTemp }} °C</p>
                <p><strong>Humidité :</strong> {{ currentHumidity }} %</p>
                <p><strong>Vent :</strong> {{ currentWind }} km/h</p>

                {% set canGoOut = (currentTemp >= 18 and currentTemp <= 28)
                                and (currentHumidity >= 30 and currentHumidity <= 70)
                                and (currentWind <= 30) %}
                {% if canGoOut %}
                    <p style=\"color: green; font-weight: bold;\">✅ Bon temps pour sortir !</p>
                {% else %}
                    <p style=\"color: red; font-weight: bold;\">❌ Pas conseillé de sortir !</p>
                {% endif %}
            </div>
        {% else %}
            <div style=\"text-align: right; min-width: 250px;\">
                <p>Aucune donnée météo disponible.</p>
            </div>
        {% endif %}
    </div>

</div> {# fin de background-container #}

{% endblock %}
", "event/showclient.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal +++\\templates\\event\\showclient.html.twig");
    }
}
