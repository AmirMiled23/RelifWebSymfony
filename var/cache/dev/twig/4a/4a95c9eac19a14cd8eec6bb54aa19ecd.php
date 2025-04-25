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

/* event/homeevenement.html.twig */
class __TwigTemplate_025b0faeb07023fe9a389a141910e87b extends Template
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
        // line 2
        return "homepage.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/homeevenement.html.twig"));

        $this->parent = $this->loadTemplate("homepage.html.twig", "event/homeevenement.html.twig", 2);
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

        yield "Nos évènements - RELIF";
        
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
        yield "  <div class=\"container mt-5\">
    <h2 class=\"mb-4\">Liste des Évènements</h2>
    <div class=\"row\">
    <form method=\"get\" action=\"\" class=\"mb-4\">
  <div class=\"row\">
    <div class=\"col-md-5\">
      <input type=\"text\" name=\"titre\" value=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 13, $this->source); })()), "request", [], "any", false, false, false, 13), "get", ["titre"], "method", false, false, false, 13), "html", null, true);
        yield "\" class=\"form-control\" placeholder=\"Rechercher par titre\">
    </div>
    <div class=\"col-md-5\">
      <input type=\"text\" name=\"ville\" value=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 16, $this->source); })()), "request", [], "any", false, false, false, 16), "get", ["ville"], "method", false, false, false, 16), "html", null, true);
        yield "\" class=\"form-control\" placeholder=\"Rechercher par ville\">
    </div>
    <div class=\"col-md-2\">
      <button type=\"submit\" class=\"btn btn-primary w-100\">Filtrer</button>
    </div>
  </div>
</form>

      <table class=\"table\">
        <thead>
            <tr>
              
                <th>Nom de l'evenement</th>
                <th>Date</th>
                
                <th>Villes</th>
                
                <th>Status</th>
                <th>Nb des participants</th>
                <th>Début dans</th>
                <th>Categorie</th>
                 
                <th>actions</th>
               
            </tr>
        </thead>
        <tbody>
        ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 43, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 44
            yield "            <tr>
               
                <td>";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nomEvent", [], "any", false, false, false, 46), "html", null, true);
            yield "</td>
                <td>";
            // line 47
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 47)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 47), "Y-m-d"), "html", null, true)) : (""));
            yield "</td>
                
                <td>";
            // line 49
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "villes", [], "any", false, false, false, 49), "html", null, true);
            yield "</td>
                
                <td>";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "statusEvent", [], "any", false, false, false, 51), "html", null, true);
            yield "</td>
                <td>";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nbParticipantMax", [], "any", false, false, false, 52), "html", null, true);
            yield "</td>
                <td>
                   <div class=\"countdown fw-bold\" data-date=\"";
            // line 54
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 54)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 54), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "\"></div>
                </td>
                <td>";
            // line 56
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 56)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 56), "nom_categorie", [], "any", false, false, false, 56), "html", null, true)) : ("N/A"));
            yield "</td>
                <td>
    <div class=\"d-flex gap-2\">
        <a href=\"";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id_event", [], "any", false, false, false, 59)]), "html", null, true);
            yield "\" class=\"btn btn-light btn-sm text-dark\" title=\"Voir\">
            <i class=\"fas fa-eye me-1\"></i> Show
        </a>
        
    </div>
</td>

            </tr>
        ";
            $context['_iterated'] = true;
        }
        // line 67
        if (!$context['_iterated']) {
            // line 68
            yield "            <tr>
                <td colspan=\"9\">Pas d'evennement</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['event'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        yield "        </tbody>
    </table>

    </div>
  </div>

  <script>
    document.addEventListener(\"DOMContentLoaded\", function() {
        const countdownElements = document.querySelectorAll(\".countdown\");

        countdownElements.forEach(el => {
            const targetDate = new Date(el.dataset.date).getTime();

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance <= 0) {
                    el.innerHTML = \" Démarré\";
                    el.classList.add(\"text-success\");
                    return;
                }

                const hoursRemaining = distance / (1000 * 60 * 60);

                if (hoursRemaining <= 2) {
                    el.innerHTML = \"<strong class='text-warning'> Va débuter dans moins de 2 heures !</strong>\";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                el.innerHTML = `\${days}j \${hours}h \${minutes}m \${seconds}s`;
            };

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    });
</script>


";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "event/homeevenement.html.twig";
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
        return array (  196 => 72,  187 => 68,  185 => 67,  172 => 59,  166 => 56,  161 => 54,  156 => 52,  152 => 51,  147 => 49,  142 => 47,  138 => 46,  134 => 44,  129 => 43,  99 => 16,  93 => 13,  85 => 7,  75 => 6,  58 => 4,  41 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("
{% extends 'homepage.html.twig' %}

{% block title %}Nos évènements - RELIF{% endblock %}

{% block body %}
  <div class=\"container mt-5\">
    <h2 class=\"mb-4\">Liste des Évènements</h2>
    <div class=\"row\">
    <form method=\"get\" action=\"\" class=\"mb-4\">
  <div class=\"row\">
    <div class=\"col-md-5\">
      <input type=\"text\" name=\"titre\" value=\"{{ app.request.get('titre') }}\" class=\"form-control\" placeholder=\"Rechercher par titre\">
    </div>
    <div class=\"col-md-5\">
      <input type=\"text\" name=\"ville\" value=\"{{ app.request.get('ville') }}\" class=\"form-control\" placeholder=\"Rechercher par ville\">
    </div>
    <div class=\"col-md-2\">
      <button type=\"submit\" class=\"btn btn-primary w-100\">Filtrer</button>
    </div>
  </div>
</form>

      <table class=\"table\">
        <thead>
            <tr>
              
                <th>Nom de l'evenement</th>
                <th>Date</th>
                
                <th>Villes</th>
                
                <th>Status</th>
                <th>Nb des participants</th>
                <th>Début dans</th>
                <th>Categorie</th>
                 
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
                <td>
                   <div class=\"countdown fw-bold\" data-date=\"{{ event.dateEvent ? event.dateEvent|date('Y-m-d H:i:s') : '' }}\"></div>
                </td>
                <td>{{ event.categorieEvent ? event.categorieEvent.nom_categorie : 'N/A' }}</td>
                <td>
    <div class=\"d-flex gap-2\">
        <a href=\"{{ path('event_show', {'id': event.id_event}) }}\" class=\"btn btn-light btn-sm text-dark\" title=\"Voir\">
            <i class=\"fas fa-eye me-1\"></i> Show
        </a>
        
    </div>
</td>

            </tr>
        {% else %}
            <tr>
                <td colspan=\"9\">Pas d'evennement</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>

    </div>
  </div>

  <script>
    document.addEventListener(\"DOMContentLoaded\", function() {
        const countdownElements = document.querySelectorAll(\".countdown\");

        countdownElements.forEach(el => {
            const targetDate = new Date(el.dataset.date).getTime();

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = targetDate - now;

                if (distance <= 0) {
                    el.innerHTML = \" Démarré\";
                    el.classList.add(\"text-success\");
                    return;
                }

                const hoursRemaining = distance / (1000 * 60 * 60);

                if (hoursRemaining <= 2) {
                    el.innerHTML = \"<strong class='text-warning'> Va débuter dans moins de 2 heures !</strong>\";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                el.innerHTML = `\${days}j \${hours}h \${minutes}m \${seconds}s`;
            };

            updateCountdown();
            setInterval(updateCountdown, 1000);
        });
    });
</script>


{% endblock %}
", "event/homeevenement.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal\\templates\\event\\homeevenement.html.twig");
    }
}
