<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          @click="leftDrawerOpen = !leftDrawerOpen"
          aria-label="Menu"
        >
          <q-icon name="menu" />
        </q-btn>

        <q-toolbar-title>
          Lanchonete 
        </q-toolbar-title>

        <div>Bem-vindo</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      bordered
      content-class="bg-grey-2"
    >
      <q-list>
        <q-item-label header>Menu</q-item-label>
        <q-item clickable to="/pedido">
          <q-item-section avatar>
            <q-icon name="img:statics/icons/icon-cliente.png" />
          </q-item-section>
          <q-item-section>
            <q-item-label>ÁREA DO CLIENTE</q-item-label>
            <q-item-label caption>Faça seu pedido aqui</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable to=/kitchen>
          <q-item-section avatar>
            <q-icon name="img:statics/icons/icons-cozinha.png" />
          </q-item-section>
          <q-item-section>
            <q-item-label>COZINHA</q-item-label>
            <q-item-label caption>Acesso restrito</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable to="/gerencia">
          <q-item-section avatar>                                     
            <q-icon name="img:statics/icons/icon-gerência.png" />
          </q-item-section>
          <q-item-section>
            <q-item-label>GERÊNCIA</q-item-label>
            <q-item-label caption>Controle e Acompanhamento</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable to="/support">
          <q-item-section avatar>
            <q-icon name="img:statics/icons/icons-suporte.png" />
          </q-item-section>
          <q-item-section>
            <q-item-label>SUPORTE</q-item-label>
            <q-item-label caption>Fale conosco</q-item-label>
          </q-item-section>
        </q-item>
       </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { openURL } from 'quasar'
export default {
  name: 'MyLayout',
  data () {
    return {
      leftDrawerOpen: this.$q.platform.is.desktop
    }
  },
  methods: {
    openURL
  }
}
</script>

<style>
</style>