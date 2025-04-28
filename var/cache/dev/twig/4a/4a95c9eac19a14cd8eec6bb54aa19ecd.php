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
        // line 1
        return "homepage.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "event/homeevenement.html.twig"));

        $this->parent = $this->loadTemplate("homepage.html.twig", "event/homeevenement.html.twig", 1);
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

        yield "Nos évènements - RELIF";
        
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
        yield "<div class=\"container\" style=\"margin-top: 120px;\" >
  <h2 class=\"mb-4\">Liste des Évènements</h2>

  <form method=\"get\" action=\"\" class=\"mb-4\">
    <div class=\"row\">
      <div class=\"col-md-5\">
        <input type=\"text\" name=\"titre\" value=\"";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 12, $this->source); })()), "request", [], "any", false, false, false, 12), "get", ["titre"], "method", false, false, false, 12), "html", null, true);
        yield "\" class=\"form-control\" placeholder=\"Rechercher par titre\">
      </div>
      <div class=\"col-md-5\">
        <input type=\"text\" name=\"ville\" value=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 15, $this->source); })()), "request", [], "any", false, false, false, 15), "get", ["ville"], "method", false, false, false, 15), "html", null, true);
        yield "\" class=\"form-control\" placeholder=\"Rechercher par ville\">
      </div>
      <div class=\"col-md-2\">
        <button type=\"submit\" class=\"btn btn-primary w-100\">Filtrer</button>
      </div>
    </div>
  </form>

  <div class=\"row\">
    ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["events"]) || array_key_exists("events", $context) ? $context["events"] : (function () { throw new RuntimeError('Variable "events" does not exist.', 24, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 25
            yield "      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 shadow-sm\">
        <style>
  .event-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
   
  }
  .card-title {
  white-space: normal;
  word-break: break-word;}
</style>
          ";
            // line 38
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 38) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 38), "image", [], "any", false, false, false, 38))) {
                // line 39
                yield "            <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 39), "image", [], "any", false, false, false, 39))), "html", null, true);
                yield "\" class=\"card-img-top event-image\" alt=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 39), "nom_categorie", [], "any", false, false, false, 39), "html", null, true);
                yield "\">
          ";
            }
            // line 41
            yield "          <div class=\"card-body card-title d-flex flex-column\">
            <h5 class=\"card-title\">";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nomEvent", [], "any", false, false, false, 42), "html", null, true);
            yield "</h5>
            <h6 class=\"card-subtitle mb-2 text-muted\">";
            // line 43
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 43)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 43), "Y-m-d"), "html", null, true)) : (""));
            yield "</h6>

            <p class=\"card-text mb-1\"><strong>Ville:</strong> ";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "villes", [], "any", false, false, false, 45), "html", null, true);
            yield "</p>
            <p class=\"card-text mb-1\"><strong>Status:</strong> ";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), Twig\Extension\CoreExtension::replace(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "statusEvent", [], "any", false, false, false, 46), ["_" => " "])), "html", null, true);
            yield "</p>
            <p class=\"card-text mb-1\"><strong>Participants max:</strong> ";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "nbParticipantMax", [], "any", false, false, false, 47), "html", null, true);
            yield "</p>
            <p class=\"card-text mb-1\"><strong>Début dans:</strong> 
              <div class=\"countdown fw-bold\" data-date=\"";
            // line 49
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 49)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["event"], "dateEvent", [], "any", false, false, false, 49), "Y-m-d H:i:s"), "html", null, true)) : (""));
            yield "\"></div>
            </p>
            <p class=\"card-text mb-3\"><strong>Catégorie:</strong> ";
            // line 51
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 51)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["event"], "categorieEvent", [], "any", false, false, false, 51), "nom_categorie", [], "any", false, false, false, 51), "html", null, true)) : ("N/A"));
            yield "</p>

            <div class=\"mt-auto\">
              <a href=\"";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("event_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["event"], "id_event", [], "any", false, false, false, 54)]), "html", null, true);
            yield "\" class=\"btn btn-primary btn-sm w-100\">
                <i class=\"fas fa-eye me-1\"></i> Voir détails
              </a>
            </div>
          </div>
        </div>
      </div>
    ";
            $context['_iterated'] = true;
        }
        // line 61
        if (!$context['_iterated']) {
            // line 62
            yield "      <div class=\"col-12\">
        <div class=\"alert alert-info\">Pas d'événements.</div>
      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['event'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        yield "  </div>

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
                  el.innerHTML = \"<strong class='text-warning'>Va débuter dans moins de 2 heures !</strong>\";
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
        return array (  200 => 66,  191 => 62,  189 => 61,  177 => 54,  171 => 51,  166 => 49,  161 => 47,  157 => 46,  153 => 45,  148 => 43,  144 => 42,  141 => 41,  133 => 39,  131 => 38,  116 => 25,  111 => 24,  99 => 15,  93 => 12,  85 => 6,  75 => 5,  58 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'homepage.html.twig' %}

{% block title %}Nos évènements - RELIF{% endblock %}

{% block body %}
<div class=\"container\" style=\"margin-top: 120px;\" >
  <h2 class=\"mb-4\">Liste des Évènements</h2>

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

  <div class=\"row\">
    {% for event in events %}
      <div class=\"col-md-4 mb-4\">
        <div class=\"card h-100 shadow-sm\">
        <style>
  .event-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
   
  }
  .card-title {
  white-space: normal;
  word-break: break-word;}
</style>
          {% if event.categorieEvent and event.categorieEvent.image %}
            <img src=\"{{ asset('uploads/' ~ event.categorieEvent.image) }}\" class=\"card-img-top event-image\" alt=\"{{ event.categorieEvent.nom_categorie }}\">
          {% endif %}
          <div class=\"card-body card-title d-flex flex-column\">
            <h5 class=\"card-title\">{{ event.nomEvent }}</h5>
            <h6 class=\"card-subtitle mb-2 text-muted\">{{ event.dateEvent ? event.dateEvent|date('Y-m-d') : '' }}</h6>

            <p class=\"card-text mb-1\"><strong>Ville:</strong> {{ event.villes }}</p>
            <p class=\"card-text mb-1\"><strong>Status:</strong> {{ event.statusEvent|replace({'_': ' '})|capitalize }}</p>
            <p class=\"card-text mb-1\"><strong>Participants max:</strong> {{ event.nbParticipantMax }}</p>
            <p class=\"card-text mb-1\"><strong>Début dans:</strong> 
              <div class=\"countdown fw-bold\" data-date=\"{{ event.dateEvent ? event.dateEvent|date('Y-m-d H:i:s') : '' }}\"></div>
            </p>
            <p class=\"card-text mb-3\"><strong>Catégorie:</strong> {{ event.categorieEvent ? event.categorieEvent.nom_categorie : 'N/A' }}</p>

            <div class=\"mt-auto\">
              <a href=\"{{ path('event_show', {'id': event.id_event}) }}\" class=\"btn btn-primary btn-sm w-100\">
                <i class=\"fas fa-eye me-1\"></i> Voir détails
              </a>
            </div>
          </div>
        </div>
      </div>
    {% else %}
      <div class=\"col-12\">
        <div class=\"alert alert-info\">Pas d'événements.</div>
      </div>
    {% endfor %}
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
                  el.innerHTML = \"<strong class='text-warning'>Va débuter dans moins de 2 heures !</strong>\";
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
", "event/homeevenement.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal +++\\templates\\event\\homeevenement.html.twig");
    }
}
