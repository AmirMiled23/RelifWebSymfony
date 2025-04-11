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

/* event/index.html.twig */
class __TwigTemplate_848cfde903cabb128441ad8ef10b2ab4 extends Template
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
        return "backoff.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/index.html.twig"));

        $this->parent = $this->loadTemplate("backoff.html.twig", "event/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Event index";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 7
        yield "<div style=\"margin-top: 90px;\">
    <h1>Event index</h1>

    <table class=\"table\">
        <thead>
            <tr>
              
                <th>Nom_event</th>
                <th>Date_event</th>
                
                <th>Villes</th>
                
                <th>Status_event</th>
                <th>Nb_participant_max</th>
                <th>CATEGORIE</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 26, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 27
            yield "            <tr>
               
                <td>";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nomEvent", [], "any", false, false, false, 29), "html", null, true);
            yield "</td>
                <td>";
            // line 30
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 30)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 30), "Y-m-d"), "html", null, true)) : (""));
            yield "</td>
                
                <td>";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "villes", [], "any", false, false, false, 32), "html", null, true);
            yield "</td>
                
                <td>";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "statusEvent", [], "any", false, false, false, 34), "html", null, true);
            yield "</td>
                <td>";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nbParticipantMax", [], "any", false, false, false, 35), "html", null, true);
            yield "</td>
                <td>";
            // line 36
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 36)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 36), "nom_categorie", [], "any", false, false, false, 36), "html", null, true)) : ("N/A"));
            yield "</td>
                <td>
    <div class=\"d-flex gap-2\">
        <a href=\"";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id_event", [], "any", false, false, false, 39)]), "html", null, true);
            yield "\" class=\"btn btn-light btn-sm text-dark\" title=\"Voir\">
            <i class=\"fas fa-eye me-1\"></i> Show
        </a>
        <a href=\"";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id_event", [], "any", false, false, false, 42)]), "html", null, true);
            yield "\" class=\"btn btn-light btn-sm text-dark\" title=\"Modifier\">
            <i class=\"fas fa-edit me-1\"></i> Edit
        </a>
    </div>
</td>

            </tr>
        ";
            $context['_iterated'] = true;
        }
        // line 49
        if (!$context['_iterated']) {
            // line 50
            yield "            <tr>
                <td colspan=\"9\">no records found</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['event'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        yield "        </tbody>
    </table>

    <a href=\"";
        // line 57
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_new");
        yield "\">Create new</a>
</div>   
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "event/index.html.twig";
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
        return array (  177 => 57,  172 => 54,  163 => 50,  161 => 49,  149 => 42,  143 => 39,  137 => 36,  133 => 35,  129 => 34,  124 => 32,  119 => 30,  115 => 29,  111 => 27,  106 => 26,  85 => 7,  75 => 6,  58 => 4,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'backoff.html.twig' %}


{% block title %}Event index{% endblock %}

{% block body %}
<div style=\"margin-top: 90px;\">
    <h1>Event index</h1>

    <table class=\"table\">
        <thead>
            <tr>
              
                <th>Nom_event</th>
                <th>Date_event</th>
                
                <th>Villes</th>
                
                <th>Status_event</th>
                <th>Nb_participant_max</th>
                <th>CATEGORIE</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
        {% for event in events %}
            <tr>
               
                <td>{{ event.nomEvent }}</td>
                <td>{{ event.dateEvent ? event.dateEvent|date('Y-m-d') : '' }}</td>
                
                <td>{{ event.villes }}</td>
                
                <td>{{ event.statusEvent }}</td>
                <td>{{ event.nbParticipantMax }}</td>
                <td>{{ event.categorieEvent ? event.categorieEvent.nom_categorie : 'N/A' }}</td>
                <td>
    <div class=\"d-flex gap-2\">
        <a href=\"{{ path('app_event_show', {'id': event.id_event}) }}\" class=\"btn btn-light btn-sm text-dark\" title=\"Voir\">
            <i class=\"fas fa-eye me-1\"></i> Show
        </a>
        <a href=\"{{ path('app_event_edit', {'id': event.id_event}) }}\" class=\"btn btn-light btn-sm text-dark\" title=\"Modifier\">
            <i class=\"fas fa-edit me-1\"></i> Edit
        </a>
    </div>
</td>

            </tr>
        {% else %}
            <tr>
                <td colspan=\"9\">no records found</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>

    <a href=\"{{ path('app_event_new') }}\">Create new</a>
</div>   
{% endblock %}
", "event/index.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal\\templates\\event\\index.html.twig");
    }
}
