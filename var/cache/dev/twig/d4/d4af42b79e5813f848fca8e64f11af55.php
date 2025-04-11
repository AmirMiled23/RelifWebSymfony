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

/* event/show.html.twig */
class __TwigTemplate_1b22043a1106ccef963f4cfc342eb765 extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/show.html.twig"));

        $this->parent = $this->loadTemplate("backoff.html.twig", "event/show.html.twig", 1);
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

        yield "Event";
        
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
        yield "<div style=\"margin-top: 90px;\">
    <h1>Event</h1>

    <table class=\"table\">
        <tbody>
            <tr>
                <th>Id_event</th>
                <td>";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 13, $this->source); })()), "idEvent", [], "any", false, false, false, 13), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Nom_event</th>
                <td>";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 17, $this->source); })()), "nomEvent", [], "any", false, false, false, 17), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Date_event</th>
                <td>";
        // line 21
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 21, $this->source); })()), "dateEvent", [], "any", false, false, false, 21)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 21, $this->source); })()), "dateEvent", [], "any", false, false, false, 21), "Y-m-d"), "html", null, true)) : (""));
        yield "</td>
            </tr>
            <tr>
                <th>Adresse_event</th>
                <td>";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 25, $this->source); })()), "adresseEvent", [], "any", false, false, false, 25), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Villes</th>
                <td>";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 29, $this->source); })()), "villes", [], "any", false, false, false, 29), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Description_event</th>
                <td>";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 33, $this->source); })()), "descriptionEvent", [], "any", false, false, false, 33), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Status_event</th>
                <td>";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 37, $this->source); })()), "statusEvent", [], "any", false, false, false, 37), "html", null, true);
        yield "</td>
            </tr>
            <tr>
                <th>Nb_participant_max</th>
                <td>";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 41, $this->source); })()), "nbParticipantMax", [], "any", false, false, false, 41), "html", null, true);
        yield "</td>
            </tr>
        </tbody>
    </table>

   <div class=\"d-flex gap-2 mt-3\">
    <a href=\"";
        // line 47
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_index");
        yield "\" class=\"btn btn-secondary\">
        <i class=\"fas fa-arrow-left me-1\"></i> Revenir à la liste
    </a>

    <a href=\"";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 51, $this->source); })()), "id_event", [], "any", false, false, false, 51)]), "html", null, true);
        yield "\" class=\"btn btn-primary\">
        <i class=\"fas fa-edit me-1\"></i> Modifier
    </a>

    <form method=\"post\" action=\"";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_event_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 55, $this->source); })()), "id_event", [], "any", false, false, false, 55)]), "html", null, true);
        yield "\" 
          onsubmit=\"return confirm('Are you sure you want to delete this item?');\" style=\"margin: 0;\">
        <input type=\"hidden\" name=\"_token\" value=\"";
        // line 57
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["event"]) || array_key_exists("event", $context) ? $context["event"] : (function () { throw new RuntimeError('Variable "event" does not exist.', 57, $this->source); })()), "id_event", [], "any", false, false, false, 57))), "html", null, true);
        yield "\">
        <button class=\"btn btn-danger\">
            <i class=\"fas fa-trash-alt me-1\"></i> Supprimer
        </button>
    </form>
</div>


    
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
        return "event/show.html.twig";
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
        return array (  171 => 57,  166 => 55,  159 => 51,  152 => 47,  143 => 41,  136 => 37,  129 => 33,  122 => 29,  115 => 25,  108 => 21,  101 => 17,  94 => 13,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'backoff.html.twig' %}

{% block title %}Event{% endblock %}

{% block body %}
<div style=\"margin-top: 90px;\">
    <h1>Event</h1>

    <table class=\"table\">
        <tbody>
            <tr>
                <th>Id_event</th>
                <td>{{ event.idEvent }}</td>
            </tr>
            <tr>
                <th>Nom_event</th>
                <td>{{ event.nomEvent }}</td>
            </tr>
            <tr>
                <th>Date_event</th>
                <td>{{ event.dateEvent ? event.dateEvent|date('Y-m-d') : '' }}</td>
            </tr>
            <tr>
                <th>Adresse_event</th>
                <td>{{ event.adresseEvent }}</td>
            </tr>
            <tr>
                <th>Villes</th>
                <td>{{ event.villes }}</td>
            </tr>
            <tr>
                <th>Description_event</th>
                <td>{{ event.descriptionEvent }}</td>
            </tr>
            <tr>
                <th>Status_event</th>
                <td>{{ event.statusEvent }}</td>
            </tr>
            <tr>
                <th>Nb_participant_max</th>
                <td>{{ event.nbParticipantMax }}</td>
            </tr>
        </tbody>
    </table>

   <div class=\"d-flex gap-2 mt-3\">
    <a href=\"{{ path('app_event_index') }}\" class=\"btn btn-secondary\">
        <i class=\"fas fa-arrow-left me-1\"></i> Revenir à la liste
    </a>

    <a href=\"{{ path('app_event_edit', {'id': event.id_event}) }}\" class=\"btn btn-primary\">
        <i class=\"fas fa-edit me-1\"></i> Modifier
    </a>

    <form method=\"post\" action=\"{{ path('app_event_delete', {'id': event.id_event}) }}\" 
          onsubmit=\"return confirm('Are you sure you want to delete this item?');\" style=\"margin: 0;\">
        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ event.id_event) }}\">
        <button class=\"btn btn-danger\">
            <i class=\"fas fa-trash-alt me-1\"></i> Supprimer
        </button>
    </form>
</div>


    
</div>
{% endblock %}
", "event/show.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal\\templates\\event\\show.html.twig");
    }
}
