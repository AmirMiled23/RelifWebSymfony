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

/* listCat.html.twig */
class __TwigTemplate_e5f6d5c30139f775ba2b20bffa729bf5 extends Template
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
        return "backoff.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "listCat.html.twig"));

        $this->parent = $this->loadTemplate("backoff.html.twig", "listCat.html.twig", 2);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Liste des Catégories";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 8
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 9
        yield "<div style=\"margin-top: 90px;\">
    <div class=\"container\">
        <h2 class=\"mb-4 text-center\">Liste des Catégories</h2>

        <table class=\"table table-striped\">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 23, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 24
            yield "                    <tr>
                        <td>";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "idCategorie", [], "any", false, false, false, 25), "html", null, true);
            yield "</td>
                        <td>";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "nomCategorie", [], "any", false, false, false, 26), "html", null, true);
            yield "</td>
                        <td>";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "description", [], "any", false, false, false, 27), "html", null, true);
            yield "</td>
                        <td>
                            ";
            // line 29
            if (CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "image", [], "any", false, false, false, 29)) {
                // line 30
                yield "                                <img src=\"";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "image", [], "any", false, false, false, 30))), "html", null, true);
                yield "\" alt=\"Image\" width=\"100\">
                            ";
            } else {
                // line 32
                yield "                                <em>Pas d'image</em>
                            ";
            }
            // line 34
            yield "                        </td>
                        <td>
                        <a href=\"";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("modifier_categorie", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "idCategorie", [], "any", false, false, false, 36)]), "html", null, true);
            yield "\"
       class=\"btn btn-primary btn-sm\" title=\"Modifier\">
        ✏️
           </a>
    <a href=\"";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("supprimer_categorie", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["cat"], "idCategorie", [], "any", false, false, false, 40)]), "html", null, true);
            yield "\"
       class=\"btn btn-danger btn-sm\"
       onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');\"
       title=\"Supprimer\">
        🗑️
    </a>
</td>

                    </tr>
                    
                ";
            $context['_iterated'] = true;
        }
        // line 50
        if (!$context['_iterated']) {
            // line 51
            yield "                    <tr>
                        <td colspan=\"4\" class=\"text-center\">Aucune catégorie trouvée.</td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['cat'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        yield "            </tbody>
        </table>
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
        return "listCat.html.twig";
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
        return array (  171 => 55,  162 => 51,  160 => 50,  145 => 40,  138 => 36,  134 => 34,  130 => 32,  124 => 30,  122 => 29,  117 => 27,  113 => 26,  109 => 25,  106 => 24,  101 => 23,  85 => 9,  75 => 8,  58 => 6,  41 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/ListCat.html.twig #}
{% extends 'backoff.html.twig' %}



{% block title %}Liste des Catégories{% endblock %}

{% block body %}
<div style=\"margin-top: 90px;\">
    <div class=\"container\">
        <h2 class=\"mb-4 text-center\">Liste des Catégories</h2>

        <table class=\"table table-striped\">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                {% for cat in categories %}
                    <tr>
                        <td>{{ cat.idCategorie }}</td>
                        <td>{{ cat.nomCategorie }}</td>
                        <td>{{ cat.description }}</td>
                        <td>
                            {% if cat.image %}
                                <img src=\"{{ asset('uploads/' ~ cat.image) }}\" alt=\"Image\" width=\"100\">
                            {% else %}
                                <em>Pas d'image</em>
                            {% endif %}
                        </td>
                        <td>
                        <a href=\"{{ path('modifier_categorie', {'id': cat.idCategorie}) }}\"
       class=\"btn btn-primary btn-sm\" title=\"Modifier\">
        ✏️
           </a>
    <a href=\"{{ path('supprimer_categorie', {'id': cat.idCategorie}) }}\"
       class=\"btn btn-danger btn-sm\"
       onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');\"
       title=\"Supprimer\">
        🗑️
    </a>
</td>

                    </tr>
                    
                {% else %}
                    <tr>
                        <td colspan=\"4\" class=\"text-center\">Aucune catégorie trouvée.</td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</div>
{% endblock %}
", "listCat.html.twig", "C:\\Users\\amirm\\Desktop\\PI WORKSHOPS\\PIRelifFinal\\templates\\ListCat.html.twig");
    }
}
