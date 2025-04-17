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

/* event/public.html.twig */
class __TwigTemplate_0c1587843e471652628163e8e389248b extends Template
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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/public.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Liste des événements</title>
</head>
<body>
    <h1>Liste des événements</h1>

    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 10, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 11
            yield "        <div style=\"border:1px solid #ccc; margin-bottom:10px; padding:10px;\">
            <p><strong>ID :</strong> ";
            // line 12
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "idEvent", [], "any", false, false, false, 12), "html", null, true);
            yield "</p>
            <p><strong>Nom :</strong> ";
            // line 13
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nomEvent", [], "any", false, false, false, 13), "html", null, true);
            yield "</p>
            <p><strong>Date :</strong> ";
            // line 14
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 14)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 14), "Y-m-d"), "html", null, true)) : ("Non définie"));
            yield "</p>
            <p><strong>Adresse :</strong> ";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "adresseEvent", [], "any", false, false, false, 15), "html", null, true);
            yield "</p>
            <p><strong>Ville :</strong> ";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "villes", [], "any", false, false, false, 16), "html", null, true);
            yield "</p>
            <p><strong>Description :</strong> ";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "descriptionEvent", [], "any", false, false, false, 17), "html", null, true);
            yield "</p>
            <p><strong>Status :</strong> ";
            // line 18
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "statusEvent", [], "any", false, false, false, 18), "html", null, true);
            yield "</p>
            <p><strong>Participants max :</strong> ";
            // line 19
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nbParticipantMax", [], "any", false, false, false, 19), "html", null, true);
            yield "</p>
        </div>
    ";
            $context['_iterated'] = true;
        }
        // line 21
        if (!$context['_iterated']) {
            // line 22
            yield "        <p>Aucun événement trouvé.</p>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['event'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        yield "</body>
</html>

";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "event/public.html.twig";
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
        return array (  108 => 24,  101 => 22,  99 => 21,  92 => 19,  88 => 18,  84 => 17,  80 => 16,  76 => 15,  72 => 14,  68 => 13,  64 => 12,  61 => 11,  56 => 10,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Liste des événements</title>
</head>
<body>
    <h1>Liste des événements</h1>

    {% for event in events %}
        <div style=\"border:1px solid #ccc; margin-bottom:10px; padding:10px;\">
            <p><strong>ID :</strong> {{ event.idEvent }}</p>
            <p><strong>Nom :</strong> {{ event.nomEvent }}</p>
            <p><strong>Date :</strong> {{ event.dateEvent ? event.dateEvent|date('Y-m-d') : 'Non définie' }}</p>
            <p><strong>Adresse :</strong> {{ event.adresseEvent }}</p>
            <p><strong>Ville :</strong> {{ event.villes }}</p>
            <p><strong>Description :</strong> {{ event.descriptionEvent }}</p>
            <p><strong>Status :</strong> {{ event.statusEvent }}</p>
            <p><strong>Participants max :</strong> {{ event.nbParticipantMax }}</p>
        </div>
    {% else %}
        <p>Aucun événement trouvé.</p>
    {% endfor %}
</body>
</html>

", "event/public.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal\\templates\\event\\public.html.twig");
    }
}
